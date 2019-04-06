<?php

	require ("../utils.php");
	header('Content-Type: application/json; charset=UTF-8');
	
	if (!isset($_GET['since']))
	{
		json_echo(["status" => "err", "error" => "Get variable since not set."]);
		die();
	}
	
	$db = get_db();
	
	if (!$db)
	{
		json_echo(["status" => "err", "error" => "db connect failed"]);
		die();
	}
	
	$sql = "SELECT teplota, vlhkost, tlak, co2, rychlost, vyska, zem_sirka, zem_dlzka, time FROM dron_data WHERE time > ? ORDER BY time ASC";
	$q = $db->prepare($sql);
	$q->bind_param("s", $_GET['since']);
	$q->bind_result($teplota, $vlhkost, $tlak, $co2, $rychlost, $vyska, $zem_sirka, $zem_dlzka, $time);
	$result = $q->execute();
	
	if ($result)
	{
		$data = array();
		
		while ($q->fetch()) 
		{
			$data[] = [
				"teplota" 	=> $teplota, 
				"vlhkost" 	=> $vlhkost,
				"tlak"    	=> $tlak,
				"co2"		=> $co2,
				"rychlost" 	=> $rychlost,
				"vyska" 	=> $vyska,
				"zem_sirka"	=> $zem_sirka,
				"zem_dlzka"	=> $zem_dlzka,
			];
			$last = $time;
		}
		
		json_echo(["last" => $last, "data" => $data]);
	}
	else
	{
		json_echo(["status" => "err", "error" => "query failed"]);
	}
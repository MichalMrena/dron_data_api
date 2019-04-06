<?php
	
	require ("../utils.php");
	header('Content-Type: application/json; charset=UTF-8');
	$params = ['teplota', 'vlhkost', 'tlak', 'co2', 'rychlost', 'vyska', 'zem_sirka', 'zem_dlzka'];
	
	foreach ($params as $p)
	{
		if (!isset($_GET[$p]))
		{
			json_echo(["status" => "err", "error" => "Post variable $p not set."]);
			die();
		}
	}
	
	$db = get_db();
	
	if (!$db)
	{
		json_echo(["status" => "err", "error" => "db connect failed"]);
		die();
	}
	
	$sql = "INSERT INTO dron_data (". implode(',', $params) . ") VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
	$q = $db->prepare($sql);
	$q->bind_param("dddddddd", $_GET['teplota'], $_GET['vlhkost'], $_GET['tlak'], $_GET['co2'], $_GET['rychlost'], $_GET['vyska'], $_GET['zem_sirka'], $_GET['zem_dlzka']);
	$result = $q->execute();
	
	if ($result)
	{
		json_echo(["status" => "ok"]);
	}
	else
	{
		json_echo(["status" => "err", "error" => "query failed", "sql" => $sql]);
	}
<?php

	define("HOST", "127.0.0.1");
	define("USER", "dron");
	define("DB",   "dron");
	define("PASS", "dron");

	
	function get_db()
	{
		$db = new mysqli(HOST, USER, PASS, DB);
		if (!$db->connect_errno)
		{
			return $db;
		}
		else
		{
			return null;
		}
		
	}
	
	function json_echo($data)
	{
		echo json_encode($data, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);
	}
<?php

require "_sql/magus.php";

DEFINE ('DB_USER', 'root');
DEFINE ('DB_PASSWORD', 'thinker');
DEFINE ('DB_HOST', 'localhost:3306');
DEFINE ('DB_NAME', 'bluemilk');

$magus = new magus("localhost:3306", "root", "thinker", "bluemilk");
$magus->connect();

$dbc = @mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME)
OR die('Could not connect to MYSQL ' .
		mysqli_connect_error());

mysqli_query($dbc, "SET character_set_results = 'utf8', character_set_client = 'utf8', character_set_connection = 'utf8', character_set_database = 'utf8', character_set_server = 'utf8'");

?>
<?php

require_once("php_classes/DBManager.php");

$db = new DBManager();
$results = $db->searchStocks($_POST['keyword']);

for ($i=0; $i<count($results); $i++)
{
	echo '<li onclick="set_item(\''.str_replace("'", "\'", json_decode(json_encode($results[$i]), True)['symbol'] ).'\')">'. json_decode(json_encode($results[$i]), True)['symbol'] .'</li>';
}



?>
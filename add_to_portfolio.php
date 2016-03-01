<?php
ini_set("display_errors", "on");
session_start();
require_once("php_classes/PortfolioManager.php");

$PM = new PortfolioManager($_SESSION['userId']);
$PM->addStock($_POST['stock']);

header("Location: dashboard.php");

?>
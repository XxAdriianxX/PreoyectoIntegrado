<?php
require_once "autoloader.php";
$connection = new Model();
$conn = $connection->getConn();
$security = new Security();
$dniFriend = isset($_GET['dniFriend']) ? $_GET['dniFriend'] : null;
$connection->deleteFriend($_SESSION['dni'],$dniFriend);

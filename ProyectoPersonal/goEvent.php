<?php
require_once "autoloader.php";
$connection = new Model();
$conn = $connection->getConn();
$security = new Security();
$eventName = isset($_GET['eventName']) ? $_GET['eventName'] : null;
$eventDate = isset($_GET['eventDate']) ? $_GET['eventDate'] : null;
$connection->goEvent($eventName, $eventDate);

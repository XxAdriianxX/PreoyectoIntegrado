<?php
require_once "autoloader.php";
$dni2 = $_GET['dniFriend'];
$connection = new Model();
$conn = $connection->getConn();
$security = new Security();
$connection->addFriends($dni2);


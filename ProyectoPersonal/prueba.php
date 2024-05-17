<?php
require_once "autoloader.php";
$connection = new EventList();
$conn = $connection->getConn();
$connection->getAllFriends(123456789); 
 
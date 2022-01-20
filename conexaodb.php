<?php
$host = "localhost";
$user = "root";
$pass = "";
$dbmane = "caduser";
$port = "3306";

$conn = new PDO("mysql:host=$host; port=$port; dbname=".$dbmane, $user, $pass);

<?php
include 'environment.php';

$serverName = $_ENV['DB_HOST'];
$userName = $_ENV['DB_USER'];
$password = $_ENV['DB_PASS'];
$databaseName = $_ENV['DB_NAME'];

$connect = mysqli_connect($serverName, $userName, $password, $databaseName);
if (!$connect) {
    die("Connection failed: " . mysqli_connect_error());
}

#echo "<script>alert('Connected!');</script>";
?>

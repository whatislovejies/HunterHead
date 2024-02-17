<?php
$hostname = 'localhost';
$username = 'root';
$password = '';
$dbname = 'WORK';
$port = '';

$conn = mysqli_connect($hostname, $username, $password, $dbname);
mysqli_set_charset($conn,"utf8mb4");
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
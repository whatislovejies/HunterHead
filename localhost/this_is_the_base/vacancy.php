<?php
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
require_once 'conect.db.php';

$query = "SELECT * FROM vacancy";
$result = mysqli_query($conn, $query) or die(mysqli_error($conn));

// Формируем массив с данными вакансий
$data = array();
while ($row = mysqli_fetch_assoc($result)) {
  $data[] = $row;
}

// Отправляем данные в виде JSON
echo json_encode($data);
?>
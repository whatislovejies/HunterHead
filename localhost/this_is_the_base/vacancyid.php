<?php
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
require_once 'conect.db.php';
// Получение идентификатора вакансии из параметров запроса
$vacancyId = $_GET['id'];

// Формирование SQL-запроса для получения информации о вакансии
$sql = "SELECT * FROM vacancy WHERE id = '$vacancyId'";

$result = $conn->query($sql);

// Проверка наличия результатов
if ($result->num_rows > 0) {
  // Получение данных о вакансии
  $row = $result->fetch_assoc();
  
  // Формирование JSON-ответа с информацией о вакансии
  $response = json_encode($row);
  
  // Отправка ответа
  header('Content-Type: application/json');
  echo $response;
} else {
  // Вакансия с указанным идентификатором не найдена
  echo "Вакансия не найдена.";
}

// Закрытие соединения с базой данных
$conn->close();

?>

<?php
header("Access-Control-Allow-Origin: http://localhost:5173");
header("Access-Control-Allow-Headers: Content-Type");
header("Content-Type: application/json");
// Получение идентификатора отклика из параметров запроса
if (isset($_GET['responseId'])) {
  $responseId = $_GET['responseId'];
} else {
  // Если идентификатор отклика не передан, выведите сообщение об ошибке
  die('Идентификатор отклика не указан.');
}
require_once 'conect.db.php';
// Выполнение SQL-запроса для изменения статуса отклика
$sql = "UPDATE response SET status = 'отклонен' WHERE id_re = '$responseId'";
// Здесь предполагается, что у вас уже установлено соединение с базой данных и используется подходящий объект соединения, например, $conn

if ($conn->query($sql) === TRUE) {
  echo 'Отклик успешно отклонен.';
} else {
  echo 'Ошибка при отклонении отклика: ' . $conn->error;
}

// Закрытие соединения с базой данных
$conn->close();
?>

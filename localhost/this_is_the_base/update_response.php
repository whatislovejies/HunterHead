<?php
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
require_once 'conect.db.php';

// Проверка наличия идентификатора вакансии в запросе
if (isset($_GET['id'])) {
  $responseId = $_GET['id'];

  // Получение данных вакансии из тела запроса
  $requestData = $_GET['editedResponse'];
  // Проверка наличия данных вакансии
  if ($requestData) {
    // Получение значений полей вакансии
    $status = $requestData['status'];
   
    // Добавьте остальные поля для обновления

    // Выполнение SQL-запроса для обновления вакансии по идентификатору
    $sql = "UPDATE response SET 
    status = '$status'
    WHERE id_re = '$responseId'";
    // Добавьте остальные поля для обновления

    $result = $conn->query($sql);

    if ($result) {
      // Успешное обновление вакансии
      echo json_encode(array('message' => 'Вакансия успешно обновлена'));
    } else {
      // Ошибка при обновлении вакансии
      echo json_encode(array('error' => 'Ошибка при обновлении вакансии'));
    }
  } else {
    // Нет данных вакансии в запросе
    echo json_encode(array('error' => 'Данные вакансии не найдены',$requestData));
  }
} else {
  // Идентификатор вакансии не найден в запросе
  echo json_encode(array('error' => 'Идентификатор вакансии не указан'));
}

// Закрытие соединения с базой данных
$conn->close();
?>

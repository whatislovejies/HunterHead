<?php
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
require_once 'conect.db.php';

// Проверка наличия идентификатора вакансии в запросе
if (isset($_GET['id'])) {
  $resumeId = $_GET['id'];

  // Получение данных вакансии из тела запроса
  $requestData = $_GET['editedResume'];
  // Проверка наличия данных вакансии
  if ($requestData) {
    // Получение значений полей вакансии
    $work_experience = $requestData['work_experience'];
    $desired_position = $requestData['desired_position'];
    $desired_salary = $requestData['desired_salary'];
    $move = $requestData['move'];
    $busyness = $requestData['busyness'];
    $work_schedule = $requestData['work_schedule'];
    $work_permit = $requestData['work_permit'];
    $availability_car = $requestData['availability_car'];
    // Добавьте остальные поля для обновления

    // Выполнение SQL-запроса для обновления вакансии по идентификатору
    $sql = "UPDATE resume SET 
    work_experience = '$work_experience', 
    desired_position = '$desired_position', 
    desired_salary = '$desired_salary', 
    move = '$move',
    busyness = '$busyness',
    work_schedule = '$work_schedule',
    work_permit = '$work_permit',
    availability_car = '$availability_car'
    WHERE id = '$resumeId'";
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

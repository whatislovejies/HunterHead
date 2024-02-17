<?php
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
require_once 'conect.db.php';

// Проверка наличия идентификатора вакансии в запросе
if (isset($_GET['id'])) {
  $vacancyId = $_GET['id'];

  // Получение данных вакансии из тела запроса
  $requestData = $_GET['editedVacancy'];
  // Проверка наличия данных вакансии
  if ($requestData) {
    // Получение значений полей вакансии
    $title = $requestData['title'];
    $salary = $requestData['salary'];
    $placeWork = $requestData['place_work'];
    $descriptionVacancy = $requestData['description_vacancy'];
    $workExperience = $requestData['work_experience'];
    $employeeResponsibilities = $requestData['employee_responsibilities'];
    $keySkills = $requestData['key_skills'];
    $category = $requestData['category'];
    // Добавьте остальные поля для обновления

    // Выполнение SQL-запроса для обновления вакансии по идентификатору
    $sql = "UPDATE vacancy SET 
    title = '$title', 
    salary = '$salary', 
    place_work = '$placeWork', 
    description_vacancy = '$descriptionVacancy',
    work_experience = '$workExperience',
    employee_responsibilities = '$employeeResponsibilities',
    key_skills = '$keySkills',
    category = '$category'
    WHERE id = '$vacancyId'";
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

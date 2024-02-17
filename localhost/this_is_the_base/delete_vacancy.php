<?php
header('Access-Control-Allow-Origin: http://localhost:5173');
header('Access-Control-Allow-Methods: POST, GET, OPTIONS, PUT, DELETE');
header('Access-Control-Allow-Headers: Content-Type');
header('Content-Type: application/json');

// Получение идентификатора работодателя из параметров запроса
$employerId = $_GET['id_employer'];

// Выполнение SQL-запросов к базе данных для удаления откликов и вакансии
// Замените нижестоящий код на ваши SQL-запросы, которые удаляют отклики и вакансию по идентификатору работодателя
// Обратите внимание, что вам может потребоваться настроить подключение к базе данных
require_once 'conect.db.php';

// Удаление откликов на вакансию
$sqlDeleteResponses = "DELETE FROM response WHERE vacancy_id IN (SELECT id FROM vacancy WHERE id_employer = $employerId)";
$conn->query($sqlDeleteResponses);

// Удаление вакансии
$sqlDeleteVacancy = "DELETE FROM vacancy WHERE id_employer = $employerId";
$conn->query($sqlDeleteVacancy);

// Проверка успешности выполнения запросов
if ($conn->affected_rows > 0) {
    $success = true;
} else {
    $success = false;
}

// Закрываем соединение с базой данных
$conn->close();

// Возвращаем результат в формате JSON
echo json_encode($success);
?>

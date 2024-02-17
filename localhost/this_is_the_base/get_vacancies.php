<?php
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');

// Подключение к базе данных
require_once 'conect.db.php';

// Выполнение SQL-запроса для выборки всех вакансий
$sql = "SELECT * FROM vacancy";
$result = $conn->query($sql);

// Проверка наличия результатов
if ($result->num_rows > 0) {
    $vacancies = array();

    // Получение данных каждой вакансии
    while ($row = $result->fetch_assoc()) {
        $vacancy = $row;
        
        $vacancies[] = $vacancy;
    }

    // Возвращение результатов в формате JSON
    echo json_encode($vacancies);
} else {
    // Если нет вакансий, возвращается пустой массив
    echo json_encode(array());
}

// Закрытие соединения с базой данных
$conn->close();
?>

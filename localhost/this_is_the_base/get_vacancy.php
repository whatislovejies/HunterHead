<?php
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');

// Подключение к базе данных
require_once 'conect.db.php';
$id = $_GET['id']; // Обновлено: получение id из GET-параметров
// Выполнение SQL-запроса для выборки вакансии по id
$sql = "SELECT * FROM vacancy WHERE id = '$id'";
$result = $conn->query($sql);

// Проверка наличия результата
if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $vacancy = $row;

    // Возвращение результата в формате JSON
    echo json_encode($vacancy);
} else {
    // Если вакансия не найдена, возвращается пустой объект
    echo json_encode((object) array());
}

// Закрытие соединения с базой данных
$conn->close();
?>

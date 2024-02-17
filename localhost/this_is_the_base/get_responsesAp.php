<?php
header('Access-Control-Allow-Origin: http://localhost:5173');
header('Access-Control-Allow-Methods: POST, GET, OPTIONS, PUT, DELETE');
header('Access-Control-Allow-Headers: Content-Type');
header('Content-Type: application/json');

// Получение идентификатора пользователя (соискателя) из параметров запроса
$userId = $_GET['userId'];

// Выполнение SQL-запроса к базе данных для получения откликов соискателя
// Замените нижестоящий код на ваш SQL-запрос, который выбирает необходимые данные из таблицы откликов
// Обратите внимание, что вам может потребоваться настроить подключение к базе данных
require_once 'conect.db.php';

$sql = "SELECT r.id_re, v.title AS vacancy_title,r.status
        FROM response r
        JOIN vacancy v ON r.vacancy_id = v.id
        WHERE r.user_id = $userId";
$result = $conn->query($sql);

$responses = array();
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $responses[] = $row;
    }
}

// Закрываем соединение с базой данных
$conn->close();

// Возвращаем результаты в формате JSON
echo json_encode($responses);
?>

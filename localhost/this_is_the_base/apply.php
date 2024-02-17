<?php
header('Access-Control-Allow-Origin: http://localhost:5173');
header('Access-Control-Allow-Methods: POST, GET, OPTIONS, PUT, DELETE');
header('Access-Control-Allow-Headers: Content-Type');
header('Content-Type: application/json');
require_once 'conect.db.php';

echo $_GET['vacancyId'];

if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    // Получаем данные из POST-запроса
    $vacancyId = $_GET['vacancyId'];
    $userId = $_GET['userId'];

    // Подготавливаем SQL-запрос для вставки данных в таблицу response
    $sqlInsertResponse = "INSERT INTO response (vacancy_id, user_id,status)
                          VALUES ('$vacancyId', '$userId', 'new')";

    // Выполняем SQL-запрос
    if ($conn->query($sqlInsertResponse) === TRUE) {
        // Отправляем успешный ответ
        echo json_encode(array('success' => true));
    } else {
        // Отправляем ответ с ошибкой
        echo json_encode(array('success' => false, 'message' => 'Ошибка при сохранении отклика'));
    }
} else {
    // Отправляем ответ с ошибкой о неправильном методе запроса
    echo json_encode(array('success' => false, 'message' => 'Неправильный метод запроса'));
}

// Закрываем соединение с базой данных
$conn->close();
?>

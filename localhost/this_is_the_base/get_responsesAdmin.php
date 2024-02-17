<?php
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
require_once 'conect.db.php';

$sql = "SELECT * FROM response";
$result = $conn->query($sql);

// Проверка наличия результатов
if ($result->num_rows > 0) {
    $responses = array();

    // Получение данных каждого отклика
    while ($row = $result->fetch_assoc()) {
        $responses[] = $row;
    }

    // Возвращение результатов в формате JSON
    echo json_encode($responses);
} else {
    // Если нет откликов, возвращается пустой массив
    echo json_encode(array());
}

// Закрытие соединения с базой данных
$conn->close();
?>

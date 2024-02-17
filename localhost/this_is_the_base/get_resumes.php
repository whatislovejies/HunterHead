<?php
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
require_once 'conect.db.php';
// Здесь вам нужно подключиться к вашей базе данных и выполнить соответствующий запрос для получения резюме

// Выполнение SQL-запроса для выборки всех резюме
$sql = "SELECT * FROM resume";
$result = $conn->query($sql);

// Проверка наличия результатов
if ($result->num_rows > 0) {
    $resumes = array();

    // Получение данных каждого резюме
    while ($row = $result->fetch_assoc()) {
        $resumes[] = $row;
    }

    // Возвращение результатов в формате JSON
    echo json_encode($resumes);
} else {
    // Если нет резюме, возвращается пустой массив
    echo json_encode(array());
}

// Закрытие соединения с базой данных
$conn->close();
?>

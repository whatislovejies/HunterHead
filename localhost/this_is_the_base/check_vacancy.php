<?php
header('Access-Control-Allow-Origin: http://localhost:5173');
header('Access-Control-Allow-Methods: POST, GET, OPTIONS, PUT, DELETE');
header('Access-Control-Allow-Headers: Content-Type');
header('Content-Type: application/json');
require_once 'conect.db.php';

$id_app = $_GET['id_app'];

$sql = "SELECT COUNT(*) as vacancyCount FROM vacancy WHERE id_employer = '$id_app'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $resumeCount = $row['vacancyCount'];

    if ($resumeCount > 0) {
        // У пользователя есть резюме
        echo json_encode(array('hasVacancy' => true));
    } else {
        // У пользователя нет резюме
        echo json_encode(array('hasVacancy' => false));
    }
} else {
    // Ошибка выполнения запроса или отсутствие данных
    echo json_encode(array('error' => 'Ошибка при проверке резюме пользователя'));
}

$conn->close();
?>

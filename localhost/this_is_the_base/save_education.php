<?php
header('Access-Control-Allow-Origin: http://localhost:5173');
header('Access-Control-Allow-Methods: POST, GET, OPTIONS, PUT, DELETE');
header('Access-Control-Allow-Headers: Content-Type');
header('Content-Type: application/json');
require_once 'conect.db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $json = file_get_contents('php://input');
    $requestData = json_decode($json, true);
    $education = $requestData['education'];
    // SQL-запрос для добавления данных в таблицу "education"
    $sql = "INSERT INTO education (level, educational_institution, faculty, specialization, year_graduation)
            VALUES ('{$education['level']}', '{$education['educational_institution']}', '{$education['faculty']}', '{$education['specialization']}', '{$education['year_graduation']}')";

    if ($conn->query($sql) === TRUE) {
        $educationId = $conn->insert_id;
        echo json_encode(array("educationId" => $educationId));
    } else {
        echo "Ошибка при добавлении данных: " . $conn->error;
    }
}

// Закрытие соединения с базой данных
$conn->close();
?>

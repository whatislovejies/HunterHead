<?php
header('Access-Control-Allow-Origin: http://localhost:5173');
header('Access-Control-Allow-Methods: POST, GET, OPTIONS, PUT, DELETE');
header('Access-Control-Allow-Headers: Content-Type');
header('Content-Type: application/json');
require_once 'conect.db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
     
    // Получение данных из тела запроса
    $json = file_get_contents('php://input');
    $requestData = json_decode($json, true);
    $resume = $requestData['resume'];
    $educationId = $requestData["educationId"];
    $idApp = $requestData['id_app'];
    
    // Проверка наличия и непустоты обязательных полей
    $desiredPosition = isset($resume['desiredPosition']) ? $resume['desiredPosition'] : '';
    $desiredSalary = isset($resume['desiredSalary']) ? $resume['desiredSalary'] : '';
    
    // SQL-запрос для добавления данных в таблицу "resume"
    $stmt = $conn->prepare("INSERT INTO resume (work_experience, desired_position, desired_salary, move, busyness, work_schedule, work_permit, availability_car, id_education, id_app)
VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("ssssssssii", $resume['workExperience'], $desiredPosition, $desiredSalary, $resume['move'], $resume['busyness'], $resume['workSchedule'], $resume['workPermit'], $resume['availabilityCar'], $educationId, $idApp);

    if ($stmt->execute()) {
        $resumeId = $conn->insert_id;
        header('Access-Control-Allow-Origin: http://localhost:5173');
        echo json_encode(array("resumeId" => $resumeId));
    } else {
        echo "Ошибка при добавлении данных: " . $stmt->error;
    }
}

// Закрытие соединения с базой данных
$conn->close();
?>

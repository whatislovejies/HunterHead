<?php
header('Access-Control-Allow-Origin: http://localhost:5173');
header('Access-Control-Allow-Methods: POST, GET, OPTIONS, PUT, DELETE');
header('Access-Control-Allow-Headers: Content-Type');
header('Content-Type: application/json');
require_once 'conect.db.php';

// Проверяем наличие ключа "id_app" в массиве $_GET
if (isset($_GET['id_app'])) {
    $idApp = $_GET['id_app'];

    // Запрос к базе данных для получения данных из таблицы "resume"
    $sqlResume = "SELECT * FROM resume WHERE id_app = '$idApp'";
    $resultResume = $conn->query($sqlResume);
    $resumeData = $resultResume->fetch_assoc();

    // Проверяем, что $resumeData не равно null
    if ($resumeData !== null) {
        $educationId = $resumeData['id_education'];

        // Запрос к базе данных для получения данных из таблицы "education"
        $sqlEducation = "SELECT * FROM education WHERE id = '$educationId'";
        $resultEducation = $conn->query($sqlEducation);
        $educationData = $resultEducation->fetch_assoc();

        // Создание ассоциативного массива с данными об образовании и резюме
        $data = array(
            'resume' => $resumeData,
            'education' => $educationData
        );

        // Возвращаем данные в формате JSON
        echo json_encode($data);

        // Обработка POST-запроса для обновления данных
        
    } else {
        echo "Error: No resume data found for the specified id_app";
    }
} else {
    echo "Error: Missing id_app parameter";
}

// Закрываем соединение с базой данных
$conn->close();
?>

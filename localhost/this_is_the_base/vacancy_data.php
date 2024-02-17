<?php
header('Access-Control-Allow-Origin: http://localhost:5173');
header('Access-Control-Allow-Methods: POST, GET, OPTIONS, PUT, DELETE');
header('Access-Control-Allow-Headers: Content-Type');
header('Content-Type: application/json');
require_once 'conect.db.php';

// Проверяем наличие ключа "id_app" в массиве $_GET
if (isset($_GET['id_employer'])) {
    $id_employer = $_GET['id_employer'];

    // Запрос к базе данных для получения данных из таблицы "resume"
    $sqlVacancy = "SELECT * FROM vacancy WHERE id_employer = '$id_employer'";
    $resultResume = $conn->query($sqlVacancy);
    $vacancyData = $resultResume->fetch_assoc();

    // Проверяем, что $resumeData не равно null
    if ($vacancyData !== null) {
        $id_specialization = $vacancyData['id_specialization'];

        // Запрос к базе данных для получения данных из таблицы "education"
        $sqlSpecialization = "SELECT * FROM specialization WHERE id = '$id_specialization'";
        $resultSpecialization = $conn->query($sqlSpecialization);
        $specialization = $resultSpecialization->fetch_assoc();

        $id_work_schedule = $vacancyData['id_work_schedule'];

        $sqlWork_schedule = "SELECT * FROM work_schedule WHERE id = '$id_work_schedule'";
        $resultWork_schedule = $conn->query($sqlWork_schedule);
        $work_schedule = $resultWork_schedule->fetch_assoc();


        // Создание ассоциативного массива с данными об образовании и резюме
        $data = array(
            'vacancy' => $vacancyData,
            'specialization' => $specialization,
            'work_schedule' => $work_schedule,
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

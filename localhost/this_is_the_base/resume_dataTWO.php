<?php
header('Access-Control-Allow-Origin: http://localhost:5173');
header('Access-Control-Allow-Methods: POST, GET, OPTIONS, PUT, DELETE');
header('Access-Control-Allow-Headers: Content-Type');
header('Content-Type: application/json');
require_once 'conect.db.php';

// Проверяем наличие ключей "id_app" и "resumeData" в массиве $_POST
var_dump($_GET);

if (isset($_GET['id_app']) && isset($_GET['resumeData'])) {
    $idApp = $_GET['id_app'];
    $resumeData = $_GET['resumeData'];

    // Обновляем данные в таблице "resume"
    $sqlUpdateResume = "UPDATE resume SET
        work_experience = '{$resumeData['work_experience']}',
        desired_position = '{$resumeData['desired_position']}',
        desired_salary = '{$resumeData['desired_salary']}',
        move = '{$resumeData['move']}',
        busyness = '{$resumeData['busyness']}',
        work_schedule = '{$resumeData['work_schedule']}',
        work_permit = '{$resumeData['work_permit']}',
        availability_car = '{$resumeData['availability_car']}'
      WHERE id_app = '$idApp'";

    $resultUpdateResume = $conn->query($sqlUpdateResume);

    if ($resultUpdateResume) {
        // Обновляем данные в таблице "education"
        $educationId = $resumeData['educationId'];
        $level = $resumeData['level'];
        $educational_institution = $resumeData['educational_institution'];
        $faculty = $resumeData['faculty'];
        $specialization = $resumeData['specialization'];
        $year_graduation = $resumeData['year_graduation'];

        $sqlUpdateEducation = "UPDATE education SET
            level = '$level',
            educational_institution = '$educational_institution',
            faculty = '$faculty',
            specialization = '$specialization',
            year_graduation = '$year_graduation'
          WHERE id = '$educationId'";

        $resultUpdateEducation = $conn->query($sqlUpdateEducation);

        if ($resultUpdateEducation) {
            echo json_encode(array('success' => true));
        } else {
            echo json_encode(array('success' => false, 'message' => 'Ошибка при обновлении данных об образовании'));
        }
    } else {
        echo json_encode(array('success' => false, 'message' => 'Ошибка при обновлении данных резюме'));
    }
} else {
    echo json_encode(array('success' => false, 'message' => 'Недостаточно данных для обновления', 'per' => $_POST));
}

// Закрываем соединение с базой данных
$conn->close();
?>

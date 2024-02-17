<?php
header('Access-Control-Allow-Origin: http://localhost:5173');
header('Access-Control-Allow-Methods: POST, GET, OPTIONS, PUT, DELETE');
header('Access-Control-Allow-Headers: Content-Type');
header('Content-Type: application/json');
require_once 'conect.db.php';

// Проверяем наличие ключей "id_app" и "resumeData" в массиве $_POST
var_dump($_GET);

if (isset($_GET['id_employer']) && isset($_GET['vacancyData'])) {
    $id_employer = $_GET['id_employer'];
    $vacancyData = $_GET['vacancyData'];
    $specialization = $_GET['specializationid'];
    $work_schedule = $_GET['id_work'];
    

    // Обновляем данные в таблице "vacancy"
    $sqlUpdateVacancy = "UPDATE vacancy SET
    title = '{$vacancyData['title']}',
    salary = '{$vacancyData['salary']}',
    place_work = '{$vacancyData['place_work']}',
    description_vacancy = '{$vacancyData['description_vacancy']}',
    work_experience = '{$vacancyData['work_experience']}',
    employee_responsibilities = '{$vacancyData['employee_responsibilities']}',
    key_skills = '{$vacancyData['key_skills']}'
    WHERE id_employer = '$id_employer'";


    $resultUpdateVacancy = $conn->query($sqlUpdateVacancy);

    if ($resultUpdateVacancy) {
        // Обновляем данные в таблице "specialization"
        $title_specializ = $vacancyData['title_specializ'];
        $discharge = $vacancyData['discharge'];
    
        $sqlUpdateSpecialization = "UPDATE specialization SET
            title_specializ = '$title_specializ',
            discharge = '$discharge'
            WHERE id = '$specialization'";
    
        $resultUpdateSpecialization = $conn->query($sqlUpdateSpecialization);
    
        // Обновляем данные в таблице "work_schedule"
        $operating_mode = $vacancyData['operating_mode'];
        $work_schedulee = $vacancyData['work_schedule'];
    
        $sqlUpdateWorkSchedule = "UPDATE work_schedule SET
            operating_mode = '$operating_mode',
            work_schedule = '$work_schedulee'
            WHERE id = '$work_schedule'";
    
        $resultUpdateWorkSchedule = $conn->query($sqlUpdateWorkSchedule);
    
        if ($resultUpdateSpecialization && $resultUpdateWorkSchedule) {
            echo json_encode(array('success' => true));
        } else {
            echo json_encode(array('success' => false, 'message' => 'Ошибка при обновлении данных специализации или графика работы'));
        }
    } else {
        echo json_encode(array('success' => false, 'message' => 'Ошибка при обновлении данных вакансии'));
    }
    
}
// Закрываем соединение с базой данных
$conn->close();
?>

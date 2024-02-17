<?php
header("Access-Control-Allow-Origin: http://localhost:5173");
header("Access-Control-Allow-Headers: Content-Type");
header("Content-Type: application/json");
require_once 'conect.db.php';

$json = file_get_contents('php://input');
$requestData = json_decode($json, true);
$vacancy = $requestData['vacancy'];
$id_app = $requestData['id_app'];
$id_work = $requestData['id_work'] ;
$specializationid = $requestData['specializationid'];

try {
    // Prepare the SQL statement
    $stmt = $conn->prepare("INSERT INTO vacancy (title, salary, place_work, description_vacancy, work_experience, employee_responsibilities, key_skills, id_work_schedule, id_employer,id_specialization) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");

    // Bind the parameters
    $stmt->bind_param('ssssssssss', $vacancy['title'], $vacancy['salary'], $vacancy['place_work'], $vacancy['description_vacancy'], $vacancy['work_experience'], $vacancy['employee_responsibilities'], $vacancy['key_skills'], $id_work, $id_app,$specializationid);

    // Execute the statement
    $stmt->execute();

    echo "Data inserted successfully";
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}
$conn = null;
?>
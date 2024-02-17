<?php
header('Access-Control-Allow-Origin: http://localhost:5173');
header('Access-Control-Allow-Methods: POST, GET, OPTIONS, PUT, DELETE');
header('Access-Control-Allow-Headers: Content-Type');
header('Content-Type: application/json');
require_once 'conect.db.php';

try{
    $data = json_decode(file_get_contents('php://input'), true);

    // Extract form data
    $operating_mode = $data['operating_mode'];
    $workSchedule = $data['work_schedule'];

    try {
        // Prepare the SQL statement
        $stmt = $conn->prepare("INSERT INTO work_schedule (operating_mode, work_schedule) VALUES ('$operating_mode', '$workSchedule')");
        $stmt->execute();

        $id_work = $conn->insert_id;
        echo json_encode(['message' => 'Data saved successfully',"id_work" => $id_work]);
       
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
} catch (PDOException $e){
    // If it's not a POST request, return an error
    http_response_code(405);
    echo json_encode(['error' => 'Method Not Allowed']);
}
?>

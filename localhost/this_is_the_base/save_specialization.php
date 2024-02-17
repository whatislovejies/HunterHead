<?php
header('Access-Control-Allow-Origin: http://localhost:5173');
header('Access-Control-Allow-Methods: POST, GET, OPTIONS, PUT, DELETE');
header('Access-Control-Allow-Headers: Content-Type');
header('Content-Type: application/json');
require_once 'conect.db.php';

try {
  $data = json_decode(file_get_contents('php://input'), true);
  $specialization = $data['specialization'];
  $discharge = $data['discharge'];
    try {
      $stmt = $conn->prepare("INSERT INTO specialization (title_specializ, discharge) VALUES (?, ?)");
      $stmt->bind_param('ss', $specialization, $discharge);
      $stmt->execute();

      $specializationid = $conn->insert_id;
      echo json_encode(['message' => 'Data saved successfully',"specializationid" => $specializationid]);
} catch (PDOException $e) {
  echo "Error: " . $e->getMessage();
}}catch (PDOException $e){
  // If it's not a POST request, return an error
  http_response_code(405);
  echo json_encode(['error' => 'Method Not Allowed']);
}


?>

<?php
header('Access-Control-Allow-Origin: http://localhost:5173');
header('Access-Control-Allow-Methods: POST, GET, OPTIONS, PUT, DELETE');
header('Access-Control-Allow-Headers: Content-Type');
header('Content-Type: application/json');
require_once 'conect.db.php';
$userId = $_GET['userId'];
// Получаем данные откликов из базы данных
$sqlGetResponses = "SELECT r.id_re, v.title AS vacancy_title, a.name, a.email, re.id, r.status
                    FROM response r
                    JOIN vacancy v ON r.vacancy_id = v.id
                    JOIN applicant a ON r.user_id = a.id
                    JOIN resume re ON re.id_app = a.id
                    WHERE r.status != 'отклонен' AND v.id_employer = ?";
$stmt = $conn->prepare($sqlGetResponses);
$stmt->bind_param("i", $userId);
$stmt->execute();
$result = $stmt->get_result();

$responses = array();
if ($result->num_rows > 0) {
  while ($row = $result->fetch_assoc()) {
    $responses[] = array(
      'id' => $row['id_re'],
      'vacancy_title' => $row['vacancy_title'],
      'name' => $row['name'],
      'email' => $row['email'],
      'resume_id' => $row['id'],
      'status'=>$row['status']
    );
  }
}

// Отправляем данные откликов в формате JSON
echo json_encode($responses);

// Закрываем соединение с базой данных
$stmt->close();
$conn->close();

?>

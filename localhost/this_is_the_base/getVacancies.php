<?php 
header('Access-Control-Allow-Origin: http://localhost:5173');
header('Access-Control-Allow-Methods: POST, GET, OPTIONS, PUT, DELETE');
header('Access-Control-Allow-Headers: Content-Type');
header('Content-Type: application/json');
require_once 'conect.db.php';

if (isset($_GET['category'])) {
    $category = $_GET['category'];

    $query = "SELECT * FROM vacancy WHERE category = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param('s', $category);
    $stmt->execute();
    $result = $stmt->get_result();
    $vacancies1 = $result->fetch_all(MYSQLI_ASSOC);
    
    // Отправка данных в формате JSON
    header('Content-Type: application/json');
    echo json_encode($vacancies1);
} else {
    echo json_encode([]);
}
?>

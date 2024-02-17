<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Allow-Headers: Content-Type");
header("Content-Type: application/json");

require_once 'conect.db.php';

if (isset($_POST['email'])) {
  $Email = $_POST['email'];
  $password = $_POST['password'];
  $hashed_password = hash('sha256', $password); // хеширование пароля
  $sql = "SELECT * FROM applicant WHERE email = ? and password=?";
  $stmt = $conn->prepare($sql);
  $stmt->bind_param("ss", $Email,$hashed_password);
  $stmt->execute();
  $result = $stmt->get_result();
  if ($result->num_rows > 0) {
    // Авторизация прошла успешно
    $row = $result->fetch_assoc();
    $role = $row['role'];
    $id_app = $row['id'];
    echo json_encode(["success" => true, "role" => $role, "userId" => $id_app, "data" => "Авторизация успешна"]);
  } else {
    // Пользователь не найден или неверный пароль
    echo json_encode(["success" => false, "error" => "Неверные учетные данные"]);
  }
}

$conn->close();
header("Access-Control-Allow-Origin: http://localhost:5173");
?>

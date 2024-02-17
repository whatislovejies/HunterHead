<?php
header("Access-Control-Allow-Origin: http://localhost:5173");
header("Access-Control-Allow-Headers: Content-Type");
header("Content-Type: application/json");
require_once 'conect.db.php';

if(isset($_POST['registr'])){
    $organization=$_POST['organization'];
    $number=$_POST['number'];
    $email=$_POST['Email'];
    $password=$_POST['password'];
    $hashed_password = hash('sha256', $password);

    $stmt = $conn->prepare("SELECT * FROM employer WHERE email = ?;");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows === 0) {
        $stmt = $conn->prepare("INSERT INTO employer (organization, number, email, password, role) VALUES (?, ?, ?, ?, 'employer')");
        $stmt->bind_param("ssss", $organization, $number, $email, $hashed_password);
        if ($stmt->execute()) {
            $role = 'employer'; // Ваша переменная роли
            $id_app = $stmt->insert_id; // Получение ID вставленной записи
            echo json_encode(["success" => true, "role" => $role, "userId" => $id_app, "data" => "Авторизация успешна"]);
        } else {
            // Если данные не были добавлены, вернуть "error"
            echo "error";
        }
    } else {
        // Если пользователь с такой электронной почтой уже существует, вернуть "email_exists"
        echo "email_exists";
    }
    $stmt->close();
}

$conn->close();
header("Access-Control-Allow-Origin: *");
?>
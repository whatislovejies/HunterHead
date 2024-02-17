<?php
header("Access-Control-Allow-Origin: http://localhost:5173");
header('Content-Type: application/json');
require_once 'conect.db.php';

if (isset($_POST['registr'])) {
    $surname = $_POST['surname'];
    $name = $_POST['name'];
    $patronymic = $_POST['patronymic'];
    $telephone = $_POST['telephone'];
    $date_birth = $_POST['date_birth'];
    $city_residence = $_POST['city_residence'];
    $citizenship = $_POST['citizenship'];
    $paul = $_POST['Paul'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $hashed_password = hash('sha256', $password);

    // Проверка наличия пользователя с такой же электронной почтой в базе данных
    $stmt = $conn->prepare("SELECT * FROM applicant WHERE email = ?;");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows === 0) {
        // Защита от SQL-инъекции с помощью подготовленных инструкций
        $stmt = $conn->prepare("INSERT INTO applicant(Surname, name, patronymic, telephone, date_birth, city_residence, Paul, Email, password, citizenship, role) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, 'applicant')");
        $stmt->bind_param("ssssssssss", $surname, $name, $patronymic, $telephone, $date_birth, $city_residence, $paul, $email, $hashed_password, $citizenship);
      
        if ($stmt->execute()) {  
            $role = 'applicant'; // Ваша переменная роли
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
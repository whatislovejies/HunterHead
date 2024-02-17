<?php
header('Access-Control-Allow-Origin: http://localhost:5173');
header('Access-Control-Allow-Methods: POST, GET, OPTIONS, PUT, DELETE');
header('Access-Control-Allow-Headers: Content-Type');
header('Content-Type: application/json');
require_once 'conect.db.php';

$idApp = $_GET['id_app']; // Пришло через GET-параметр, не через JSON

// Запрос к базе данных для получения данных пользователя
$sql = "SELECT id, surname, name, patronymic, telephone, date_birth, city_residence, Paul, citizenship, role, Email, password FROM applicant WHERE id = '$idApp'";

$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // Обработка результата запроса и формирование массива данных пользователя
    $userData = $result->fetch_assoc();
    $userData['hashed_password'] = $userData['password'];
    // Возвращаем данные в формате JSON
    header('Content-Type: application/json');
    echo json_encode($userData);
} else {
    echo "User not found";
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Обработка обновления данных пользователя
    $json = file_get_contents('php://input');
    $requestData = json_decode($json, true);
    $idApp = $requestData['id_app'];
    $surname = $requestData['surname'];
    $name = $requestData['name'];
    $patronymic = $requestData['patronymic'];
    $telephone = $requestData['telephone'];
    $date_birth = $requestData['date_birth'];
    $city_residence = $requestData['city_residence'];
    $Paul = $requestData['Paul'];
    $citizenship = $requestData['citizenship'];
    $Email = $requestData['Email'];
    $password = $requestData['hashed_password'];

    // Хэширование пароля
    $hashed_password = hash('sha256', $password);

    // Запрос к базе данных для обновления данных пользователя
    $updateSql = "UPDATE applicant SET
        surname = '$surname',
        name = '$name',
        patronymic = '$patronymic',
        telephone = '$telephone',
        date_birth = '$date_birth',
        city_residence = '$city_residence',
        Paul = '$Paul',
        citizenship = '$citizenship',
        email = '$Email',
        password = '$hashed_password'
    WHERE id = '$idApp'";

    if ($conn->query($updateSql) === TRUE) {
        echo "User updated successfully";
    } else {
        echo "Error updating user: " . $conn->error;
    }
}

$conn->close();
?>
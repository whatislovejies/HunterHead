<?php
header('Access-Control-Allow-Origin: http://localhost:5173');
header('Access-Control-Allow-Methods: POST, GET, OPTIONS, PUT, DELETE');
header('Access-Control-Allow-Headers: Content-Type');
header('Content-Type: application/json');
require_once 'conect.db.php';
// Обработчик запроса на поиск вакансий
if (isset($_GET['searchText'])) {
    $searchText = $_GET['searchText'];

    // Формирование SQL-запроса для поиска вакансий
    $sql = "SELECT * FROM vacancy WHERE title LIKE '%$searchText%' OR description_vacancy LIKE '%$searchText%'";
    $result = $conn->query($sql);

    if ($result === false) {
        die("Ошибка при выполнении запроса к базе данных: " . $conn->error);
    }

    $vacancies = [];
    while ($row = $result->fetch_assoc()) {
        $vacancies[] = $row;
    }

    echo json_encode($vacancies);
    exit(); // Добавьте эту строку, чтобы прекратить выполнение скрипта после отправки данных
}

// Обработчик запроса на сортировку вакансий
if (isset($_GET['sortBy'])) {
    $sortBy = $_GET['sortBy'];

    // Формирование SQL-запроса для сортировки вакансий
    $sql = "SELECT * FROM vacancy ORDER BY $sortBy ASC";
    $result = $conn->query($sql);

    if ($result === false) {
        die("Ошибка при выполнении запроса к базе данных: " . $conn->error);
    }

    $vacancies = [];
    while ($row = $result->fetch_assoc()) {
        $vacancies[] = $row;
    }

    echo json_encode($vacancies);
    exit(); // Добавьте эту строку, чтобы прекратить выполнение скрипта после отправки данных
}

$conn->close();
?>

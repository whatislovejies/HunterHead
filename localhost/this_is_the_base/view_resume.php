<?php
# -*- coding: utf-8 -*-
header('Content-Type: text/html; charset=utf-8');
require_once('tcpdf/tcpdf.php');

// Получение и проверка идентификатора резюме из параметров запроса
if (isset($_GET['resumeId'])) {
  $resumeId = $_GET['resumeId'];
} else {
  // Если идентификатор резюме не передан, выведите сообщение об ошибке
  die('Идентификатор резюме не указан.');
}

require_once('conect.db.php');
// Получение данных из таблицы resume
$resumeData = array();
$sqlGetResumeData = "SELECT * FROM resume WHERE id = '$resumeId'";
$resumeResult = $conn->query($sqlGetResumeData);

if ($resumeResult->num_rows > 0) {
  $resumeData = $resumeResult->fetch_assoc();
}
$app_id = $resumeData['id_app'];
$applicantData = array();
$sqlGetApplicantData = "SELECT * FROM applicant WHERE id = '$app_id'";
$applicantResult = $conn->query($sqlGetApplicantData);

if ($applicantResult->num_rows > 0) {
  $applicantData = $applicantResult->fetch_assoc();
}
// Создание нового PDF-документа
$pdf = new TCPDF();
$pdf->AddPage();
// Установка шрифта и размера шрифта
$pdf->SetFont('dejavusans', '', 12);

// Вывод данных резюме в PDF
$pdf->Cell(0, 10, 'Резюме', 0, 1, 'C');
$pdf->Ln(10); // Переход на новую строку

// Данные из таблицы applicant
$pdf->Cell(40, 10,'Фамилия: ');
$pdf->Cell(0, 10,  $applicantData['surname'], 0, 1);

$pdf->Cell(40, 10,  'Имя: ');
$pdf->Cell(0, 10,  $applicantData['name'], 0, 1);

$pdf->Cell(40, 10,  'Отчество: ');
$pdf->Cell(0, 10,  $applicantData['patronymic'], 0, 1);

$pdf->Cell(40, 10,  'Телефон: ');
$pdf->Cell(0, 10,  $applicantData['telephone'], 0, 1);

$pdf->Cell(40, 10,  'Дата рождения: ');
$pdf->Cell(0, 10,  $applicantData['date_birth'], 0, 1);

$pdf->Cell(40, 10,  'Проживание: ');
$pdf->Cell(0, 10,  $applicantData['city_residence'], 0, 1);

$pdf->Cell(40, 10,  'Гражданство: ');
$pdf->Cell(0, 10,  $applicantData['citizenship'], 0, 1);

$pdf->Cell(40, 10,  'Пол: ');
$pdf->Cell(0, 10,  $applicantData['Paul'], 0, 1);

$pdf->Cell(40, 10,  'Email: ');
$pdf->Cell(0, 10,  $applicantData['email'], 0, 1);

$pdf->Ln(10); // Переход на новую строку

// Данные из таблицы resume
$pdf->Cell(40, 10,  'Опыт работы: ');
$pdf->Cell(0, 10,  $resumeData['work_experience'], 0, 1);

$pdf->Cell(58, 10,  'Желаемая должность: ');
$pdf->Cell(10, 10,  $resumeData['desired_position'], 0, 1);

$pdf->Cell(58, 10,  'Желаемая зарплата: ');
$pdf->Cell(0, 10,  $resumeData['desired_salary'], 0, 1);

$pdf->Cell(58, 10,  'Готовность к переезду: ');
$pdf->Cell(0, 10,  $resumeData['move'], 0, 1);

$pdf->Cell(58, 10,  'Занятость: ');
$pdf->Cell(0, 10,  $resumeData['busyness'], 0, 1);

$pdf->Cell(58, 10,  'График работы: ');
$pdf->Cell(0, 10,  $resumeData['work_schedule'], 0, 1);

$pdf->Cell(58, 10,  'Разрешение на работу: ');
$pdf->Cell(0, 10,  $resumeData['work_permit'], 0, 1);

$pdf->Cell(58, 10,  'Наличие автомобиля: ');
$pdf->Cell(0, 10,  $resumeData['availability_car'], 0, 1);

// Генерация PDF и вывод в браузер
$pdf->Output('resume.pdf', 'I'); // 'D' - вывод в браузер, 'F' - сохранение в файл

// Закрытие соединения с базой данных
$conn->close();
?>

<?php
session_start();
include '../../db_conn/insert.php';
$insert = new insert();

$studentFullName = $_POST['last-name'] . ', ' . $_POST['first-name'] . ' ' . $_POST['middle-initial'] . '.';
$gender = $_POST['gender'];
$email = $_POST['email'];
$phone = $_POST['phone'];
$address = $_POST['address'];
$schedule = $_SESSION['date'];
$createdAt = date('Y-m-d H:i:s');
$requestedDocuments = $_POST['requestedDocuments'];

if (empty($_POST['last-name']) || empty($_POST['first-name']) || empty($email) || empty($phone) || empty($address)) {
    $_SESSION['error_message'] = "Please fill in all required fields.";
    header("Location: ../walkIn_form.php");
} elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    $_SESSION['error_message'] = "Invalid email format.";
    header("Location: ../walkIn_form.php");
} else {
    if ($insert->new_request(
        'Walk in',
        null,
        $studentFullName,
        $email,
        $address,
        $gender,
        $phone,
        '',
        '',
        '',
        $schedule,
        '',
        '0',
        $createdAt,
        $requestedDocuments)) {
        $_SESSION['success'] = "Request successfully submitted.";
        header("Location: ../dashboard.php?success");
    }else {
        $_SESSION['error_message'] = "There was an error while submitting the request.";
        header("Location: walkIn_form.php?transaction_failed");
    }
}


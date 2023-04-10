<?php
include '../../db_conn/operations.php';
$db = new operations();

if(isset($_POST['new_dept'])){
    $db->new_dept($_POST['dept'], $_POST['desk']) ? header("Location: ../dept_course.php?success") : header("Location: ../dept_course.php?failed");
    exit();
}
if(isset($_POST['new_course'])){
    $db->new_course($_POST['dept'], $_POST['name'], $_POST['desk']) ? header("Location: ../dept_course.php?success") : header("Location: ../dept_course.php?failed");
    exit();
}
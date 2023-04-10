<?php
include '../../db_conn/operations.php';
$db = new operations();
session_start();
if (isset($_POST['save_pro'])){
    if(!empty($_POST['lname']) || !empty($_POST['fname']) || !empty($_POST['middle']) || !empty($_POST['gender']) || !empty($_POST['address']) || !empty($_POST['email']) || !empty($_POST['phone'])){
        ($db->pro_save($_SESSION['id'],$_POST['course'],$_POST['lname'],$_POST['fname'],$_POST['middle'],$_POST['gender'],$_POST['address'],$_POST['email'],$_POST['phone'])) ?
        header("Location: ../st_main.php?success=Welcome") : header("Location: ../../st_profile.php?error");
    }else{
        header("Location: ../../st_profile.php?error=Pls fill up all the fields");
        exit();
    }
}
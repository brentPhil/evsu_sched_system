<?php
session_start();
include '../../db_conn/archive.php';
include '../../db_conn/delete.php';
$delete = new delete();
$archive = new Archive();

if(isset($_POST['deleteRequest'])){
    $requestID = $_POST['request_id'];
    if($delete->delete_request($requestID)){
        $_SESSION['success'] = "Request successfully deleted.";
    }else {
        $_SESSION['error'] = "Failed to delete request. Please try again later or contact support if the issue persists.";
    }
    header("Location: ../st_main.php");
    exit(); // to prevent further code execution after redirect
}

if(isset($_POST['archiveRequest'])) {
    $requestID = $_POST['request_id'];
    if ($archive->archive_Requests($requestID)) {
        $_SESSION['success'] = "Request successfully archived.";
    } else {
        $_SESSION['error'] = "Failed to archive request. Please try again later or contact support if the issue persists.";
    }
    header("Location: ../st_main.php");
    exit(); // to prevent further code execution after redirect
}
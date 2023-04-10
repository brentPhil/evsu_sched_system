<?php
session_start();
include '../../db_conn/operations.php';
$db = new operations();

$dept = $_POST['dept'];
$course = $_POST['course'];
$status = '';
$fullname = $_POST['fullname'];
$gender = $_POST['gender'];
$contact = $_POST['contact'];
$st_uid = $_SESSION['id'];
$type = $_POST['type'];
$_POST['graduate'] == 'Graduate' ? $status = $_POST['graduate'] : $status = $_POST['year'];
$request = [];
$sched_dt = $_POST['sched'];
$rq_id = $_POST['rq_id'];
$id_cert = $_POST['id_cert'];

if(isset($_POST['edit']))
{
    if($db->update_request($st_uid, $dept, $course, $type, $fullname, $gender, $contact, $status, $sched_dt, $rq_id)){
        $db->del_rq_cert($id_cert);
        $request = $_POST['cert_options'];
        foreach($request as $key => $value)
        {
            $requests = $_POST['cert_options'][$key];
            $db->new_rq_cert($id_cert, $requests);
        }
        header('Location: ../st_main.php?success');
    }else{
        header('Location: ../st_main.php?error = Request Update Failed');
    }
    exit();
}else{
    $rand_id = rand(0000,9999);
    $rq_status = 'pending...';
    if($db->new_request($st_uid, $rand_id, $dept, $course, $type, $fullname, $gender, $contact, $sched_dt, $status, $rq_status)){
        $request = $_POST['cert_options'];
        foreach($request as $key => $value)
        {
            $requests = $_POST['cert_options'][$key];
            $db->new_rq_cert($rand_id, $requests);
        }
        header('Location: ../st_main.php?success');
    }else{
        header('Location: ../st_main.php?error = New Request Failed');
    }

    exit();
}
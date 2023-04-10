<?php
include '../../db_conn/config.php';
include '../../db_conn/operations.php';
$db = new operations();
session_start();

if ( empty($_POST['st_id'])) {
    header("Location: ../../student_login.php?error=Pls enter username");
    exit();
}
elseif ( empty($_POST['password'])){
    header("Location: ../../student_login.php?error=Pls enter password");
    exit();
}

if ($stmt = $conn->prepare('SELECT st_id, user_name, dept_id, password FROM student WHERE username = ?')) {
    // Bind parameters (s = string, i = int, b = blob, etc), in our case the username is a string so we use "s"
    $stmt->bind_param('s', $_POST['st_id']);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows > 0) {
        $stmt->bind_result($id,$name, $dept_id, $password);
        $stmt->fetch();
        if (password_verify($_POST['password'], $password)) {
            session_regenerate_id();
            $profile=$db->pro_view($id);
            $profile = mysqli_fetch_assoc($profile);
            $_SESSION['loggedin'] = TRUE;
            $_SESSION['name'] = $name;
            $_SESSION['dept_id'] = $dept_id;
            $_SESSION['id'] = $id;
            !isset($profile['st_uid'])
                ? header("Location: ../../st_profile.php?setup")
                : header("Location: ../st_main.php?success=Welcome");
        } else {
            header("Location: ../../student_login.php?error=Incorrect Password");
        }
    } else {
        header("Location: ../../student_login.php?error=Username doesn't exist");
    }
    $stmt->close();
}


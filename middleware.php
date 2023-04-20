<?php
session_start();
! $_SESSION['id'] && ! $_SESSION["loggedin"] && ! $_SESSION['Profile_ID']
? header("Location: ../../student_login.php")
: header("Location: /student/st_main.php");

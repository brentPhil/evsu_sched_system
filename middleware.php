<?php
session_start();
!isset($_SESSION['id']) && !isset($_SESSION["loggedin"]) && !isset($_SESSION['Profile_ID'])
&& header("Location: ../student_login.php");
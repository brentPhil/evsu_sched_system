<?php
session_start();
unset($_SESSION["loggedin"]);
// Redirect to the login page:
header('Location: ../../student_login.php');
<?php
session_start();

if (isset($_SESSION['logged']) && (basename($_SERVER['PHP_SELF']) == 'login.php' || basename($_SERVER['PHP_SELF']) == 'register.php')) {
    header("Location: ../index.php");
    exit();
}

if(($_SESSION['role'] != 'teacher') && (basename($_SERVER['PHP_SELF']) == 'delete_user.php' || basename($_SERVER['PHP_SELF']) == 'edit_user.php' || basename($_SERVER['PHP_SELF']) == 'add_user.php' || basename($_SERVER['PHP_SELF']) == 'upload_assignments.php' || basename($_SERVER['PHP_SELF']) == 'view_submissions.php')){
    header("Location: ../index.php");
    exit();
}
?>
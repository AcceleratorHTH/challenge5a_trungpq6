<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
session_start();

if (!isset($_SESSION['logged'])) {
    header('Location: ./views/login.php');
    exit();
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> Mainpage </title>
    <link rel="stylesheet" href="assets/style.css">
</head>

<body>
    <div class="main-container">
        <h1> Welcome to mainpage </h1>
        <nav class="main-nav">
            <ul>
                <li><a href="views/profile.php"> Thông tin người dùng </a></li>
                <li><a href="views/user_list.php"> Danh sách người dùng </a></li>
                <li><a href="views/view_messages.php"> Hộp thư </a></li>
                <li><a href="views/view_assignments.php"> Danh sách bài tập </a></li>
            </ul>
        </nav>
        <form action="views/logout.php" method="post" class="logout-form">
            <button type="submit" name="logout"> Đăng xuất </button>
        </form>
    </div>
</body>

</html>

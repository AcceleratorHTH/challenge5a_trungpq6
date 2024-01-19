<?php
include '../config/bootstrap.php';
include "../controllers/AssignmentController.php";

$assignmentController = new AssignmentController();
if(isset($_POST['upload'])){
    $assignmentController->uploadAssignment();
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> Thêm bài tập </title>
    <link rel="stylesheet" href="../assets/style.css">
</head>
<body>
    <div class="container">
        <form action="" method="POST" enctype="multipart/form-data" class="upload-assignment-form">
            <h2> Thêm bài tập </h2>
            <div class="form-group">
                <label for="title"> Tiêu đề </label>
                <input type="text" name="title" id="title">
            </div>
            <div class="form-group">
                <label for="description"> Mô tả </label>
                <input type="text" name="description" id="description">
            </div>
            <div class="form-group">
                <label for="file_path"> Tệp đính kèm </label>
                <input type="file" name="file_path" id="file_path">
            </div>
            <div class="form-group">
                <label for="deadline"> Hạn nộp </label>
                <input type="date" name="deadline" id="deadline">
            </div>
            <button type="submit" name="upload"> Đăng </button>
        </form>
    </div>
</body>
</html>

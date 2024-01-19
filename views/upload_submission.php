<?php
include '../config/bootstrap.php';
include "../controllers/SubmissionController.php";

if(isset($_POST['upload'])){
    $submissionController = new SubmissionController();
    $submissionController->uploadSubmission();
    header("Location: view_assignments.php");
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> Nộp bài làm </title>
    <link rel="stylesheet" href="../assets/style.css">
</head>
<body>
    <div class="container">
        <h2> Nộp bài làm </h2>
        <form action="" method="POST" enctype="multipart/form-data" class="submission-form">
            <label for="file_path">Chọn file để nộp:</label>
            <input type="file" name="file_path" id="file_path">
            <input type="submit" name="upload" value="Upload" class="submit-btn">
        </form>
    </div>
</body>
</html>

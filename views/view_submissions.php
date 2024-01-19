<?php
include '../config/bootstrap.php';
include "../controllers/SubmissionController.php";

if(isset($_GET['id'])){
    $submissionController = new SubmissionController();
    $list = $submissionController->listSubmissions();
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> Danh sách bài nộp </title>
</head>
<body>
    <table>
        <h2> Danh sách bài nộp </h2>
        <th> Id học sinh </th>
        <th> Tệp đính kèm </th>
        <th> Thời gian nộp </th>
        <?php foreach ($list as $submission) : ?>
            <tr>
                <td><?php echo htmlspecialchars($submission['student_id']); ?></td>
                <td><?php echo htmlspecialchars($submission['file_path']); ?></td>
                <td><?php echo htmlspecialchars($submission['submitted_at']); ?></td>
            </tr>
        <?php endforeach; ?>
    </table>
</body>
</html>
<?php
include '../config/bootstrap.php';
include "../controllers/AssignmentController.php";

$assignmentController = new AssignmentController();
$list = $assignmentController->listAssignments();

?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> Danh sách bài tập </title>
    <link rel="stylesheet" href="../assets/style.css">
</head>

<body>
    <div class="assignment-container">
        <h2> Danh sách bài tập </h2>
        <?php if ($_SESSION['role'] == 'teacher') : ?> <a href="upload_assignments.php" class="add-assignment-btn"> Thêm bài tập </a> <?php endif; ?>
        <table class="assignment-table">
            <tr>
                <th>Tiêu đề</th>
                <th>Mô tả</th>
                <th>Tệp đính kèm</th>
                <th>Hạn nộp</th>
                <th>Thao tác</th>
            </tr>
            <?php foreach ($list as $assignment) : ?>
                <tr>
                    <td><?php echo htmlspecialchars($assignment['title']); ?></td>
                    <td><?php echo htmlspecialchars($assignment['description']); ?></td>
                    <td><a href=<?php echo htmlspecialchars($assignment['file_path']); ?>> Tải về </a></td>
                    <td><?php echo htmlspecialchars($assignment['deadline']); ?></td>
                    <td>
                        <?php if ($_SESSION['role'] != 'teacher') : ?><a href="upload_submission.php?id=<?php echo htmlspecialchars($assignment['assignment_id']); ?>"> Nộp bài </a><?php endif; ?>
                        <?php if ($_SESSION['role'] == 'teacher') : ?><a href="view_submissions.php?id=<?php echo htmlspecialchars($assignment['assignment_id']); ?>"> Xem bài nộp </a><?php endif; ?>
                    </td>
                </tr>
            <?php endforeach; ?>

        </table>
    </div>
</body>

</html>
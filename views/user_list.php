<?php
include '../config/bootstrap.php';
include "../controllers/UserController.php";

$userController = new UserController();
$list = $userController->viewUserList();

if (isset($_POST['update'])) {
    $changePassword = $userController->editUser($_SESSION['user_id'], $_POST);
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> Danh sách người dùng </title>
    <link rel="stylesheet" href="../assets/style.css">

<body>

    <div class="list-container">
        <h2> Danh sách người dùng </h2>
        <?php if ($_SESSION['role'] == 'teacher') : ?>
            <a href="add_user.php" class="add-user-btn">Thêm Học Sinh</a>
        <?php endif; ?>

        <table class="user-list">
            <tr>
                <th>ID</th>
                <th>Họ và Tên</th>
                <th>Email</th>
                <th>Số Điện Thoại</th>
                <th>Vai Trò</th>
                <th>Thao tác</th>
            </tr>
            <?php foreach ($list as $user) : ?>
                <tr>
                    <td><?php echo htmlspecialchars($user['user_id']); ?></td>
                    <td><?php echo htmlspecialchars($user['full_name']); ?></td>
                    <td><?php echo htmlspecialchars($user['email']); ?></td>
                    <td><?php echo htmlspecialchars($user['phone_number']); ?></td>
                    <td><?php echo htmlspecialchars($user['role']); ?></td>
                    <td>
                        <a href="user_details.php?id=<?php echo $user['user_id']; ?>"> Xem </a>
                        <?php if ($_SESSION['role'] == 'teacher' && $user['role'] != 'teacher') : ?>
                            <a href="profile.php?id=<?php echo $user['user_id']; ?>"> Sửa </a>
                            <a href="delete_user.php?id=<?php echo $user['user_id']; ?>" onclick="return confirm('Bạn có chắc chắn muốn xóa?');"> Xóa </a>
                        <?php endif; ?>
                    </td>

                </tr>
            <?php endforeach; ?>

        </table>
    </div>
</body>

</html>
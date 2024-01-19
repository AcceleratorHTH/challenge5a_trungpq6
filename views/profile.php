<?php
include '../config/bootstrap.php';
include '../controllers/UserController.php';

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

$userController = new UserController();

if (isset($_SESSION['user_id']) && $_SESSION['role'] == 'teacher' && isset($_GET['id'])) {
    $user_id = $_GET['id'];
    $info = $userController->viewUserProfile($user_id);
    if ($info['role'] == 'teacher') {
        header("Location: user_list.php");
        exit();
    }
} else {
    $user_id = $_SESSION['user_id'];
    $info = $userController->viewUserProfile($user_id);
}

if (isset($_POST['update'])) {
    $changePassword = $userController->editUser($user_id, $_POST);
}

if (isset($_POST['changePassword'])) {
    $changePassword = $userController->changeUserPassword($user_id, $_POST['current_password'], $_POST['new_password']);
}

if (isset($_FILES['avatar']) && $_FILES['avatar']['error'] == 0) {

    $target_dir = "uploads/avatars/";
    $target_file = $target_dir . basename($_FILES["avatar"]["name"]);
    if (move_uploaded_file($_FILES["avatar"]["tmp_name"], $target_file)) {
        $userController->updateAvatar($user_id, $target_file);
    } else {
        echo "Nope";
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> Thông tin người dùng </title>
    <link rel="stylesheet" href="../assets/style.css">
</head>

<body>
    <div class="container">
        <h1>Hồ sơ cá nhân</h1>
        <form action="" method="POST" enctype="multipart/form-data" class="profile-form">
            <h2> Thông tin cơ bản </h2>
            <div class="form-group">
                <?php if (!empty($info['avatar'])) : ?>
                    <img src="<?php echo htmlspecialchars($info['avatar']); ?>" alt="Avatar" style="width: 100px; height: 100px;">
                <?php else : ?>
                    <p>Không có avatar.</p>
                <?php endif; ?>
            </div>
            <div class="form-group">
                <label for="avatar">Avatar:</label>
                <input type="file" name="avatar">
            </div>
            <div class="form-group">
                <label for="full_name">Họ và Tên:</label>
                <input type="text" name="full_name" value="<?php echo htmlspecialchars($info['full_name']); ?>" disabled>
            </div>
            <div class="form-group">
                <label for="email">Email:</label>
                <input type="email" name="email" value="<?php echo htmlspecialchars($info['email']); ?>">
            </div>
            <div class="form-group">
                <label for="phone_number">Số Điện Thoại:</label>
                <input type="text" name="phone_number" value="<?php echo htmlspecialchars($info['phone_number']); ?>">
            </div>
            <div class="form-group">
                <button type="submit" name="update"> Cập nhật </button>
            </div>
        </form>

        <form action="" method="POST" class="change-password-form">
            <h2> Đổi mật khẩu </h2>

            <div class="form-group">
                <label for="current_password">Mật khẩu hiện tại:</label>
                <input type="password" name="current_password" required>
            </div>
            <div class="form-group">
                <label for="new_password">Mật khẩu mới:</label>
                <input type="password" name="new_password" required>
            </div>
            <div class="form-group">
                <button type="submit" name="changePassword"> Đổi Mật Khẩu </button>
            </div>
        </form>

    </div>
</body>

</html>
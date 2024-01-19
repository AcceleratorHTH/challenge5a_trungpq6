<?php

include '../config/bootstrap.php';
include '../controllers/UserController.php';
include '../controllers/MessageController.php';

if (isset($_GET['id'])) {
    $userController = new UserController();
    $info = $userController->viewUserProfile($_GET['id']);
}

if (isset($_POST['send'])) {
    $messageController = new MessageController();
    $messageController->sendMessage($_POST);
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
        <?php if (isset($info)) : ?>
            <h1>Thông tin người dùng</h1>
            <div class="user-info">
                <p>Họ và Tên: <?php echo htmlspecialchars($info['full_name']); ?></p>
                <p>Email: <?php echo htmlspecialchars($info['email']); ?></p>
                <p>Số Điện Thoại: <?php echo htmlspecialchars($info['phone_number']); ?></p>
                <p>Vai trò: <?php echo htmlspecialchars(($info['role'] == 'student') ? 'Học sinh' : 'Giáo viên'); ?></p>
            </div>
            <form action="" method="POST" class="message-form">
                <input type="hidden" name="sender_id" value="<?php echo $_SESSION['user_id']; ?>">
                <input type="hidden" name="receiver_id" value="<?php echo $_GET['id']; ?>">
                <label for="message"> Tin nhắn: </label>
                <textarea name="message" id="message"></textarea>
                <button type="submit" name="send"> Gửi </button>
            </form>
        <?php endif; ?>
    </div>
</body>

</html>
<?php
include '../config/bootstrap.php';
include '../controllers/UserController.php';

$userController = new UserController();

$message = null;
if (isset($_POST['register'])) {
    $message = $userController->register($_POST['name'], $_POST['username'], $_POST['password'], $_POST['retypePassword'], $_POST['email'], $_POST['phoneNumber']);
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> Đăng ký </title>
    <link rel="stylesheet" href="../assets/style.css">
</head>

<body>
    <div class="container">
        <h2> Đăng ký </h2>
        <form action="" method="post">
            <div class="form-group">
                <label> Họ và tên:</label><br />
                <input type="text" name="name">
            </div>
            <div class="form-group">
                <label> Tên đăng nhập:</label><br />
                <input type="text" name="username">
            </div>
            <div class="form-group">
                <label> Mật khẩu: </label><br />
                <input type="password" name="password">
            </div>
            <div class="form-group">
                <label> Nhập lại mật khẩu: </label><br />
                <input type="password" name="retypePassword">
            </div>
            <div class="form-group">
                <label> Email:</label><br />
                <input type="email" name="email">
            </div>
            <div class="form-group">
                <label> Số điện thoại:</label><br />
                <input type="text" name="phoneNumber">
            </div>
            <div class="form-group">
                <button type="submit" name="register"> Đăng ký </button>
            </div>
            <div class="message">
                <?php
                if ($message != null) {
                    echo $message;
                }
                ?>
            </div>
        </form>
    </div>

</body>

</html>
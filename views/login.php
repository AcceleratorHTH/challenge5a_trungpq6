<?php
include '../config/bootstrap.php';
include '../controllers/UserController.php';

$userController = new UserController();

if (isset($_POST['login'])) {
    $message = $userController->login($_POST['username'], $_POST['password']);
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> Đăng nhập </title>
    <link rel="stylesheet" href="../assets/style.css">
</head>

<body>
    <div class="container">
        <h2> Đăng nhập </h2>
        <form action="" method="post">
            <div>
                <label for="username"> Tên đăng nhập:</label>
                <input type="text" name="username">
            </div>
            <div>
                <label for="password"> Mật khẩu: </label>
                <input type="password" name="password">
            </div>
            <div>
                <button type="submit" name="login"> Đăng nhập </button>
            </div>
            <div class="message">
                <?php
                if (isset($message) && $message != null) {
                    echo $message;
                }
                ?>
            </div>
            <div>
                <a href="register.php"> Đăng ký </a>
            </div>
        </form>
    </div>
</body>

</html>

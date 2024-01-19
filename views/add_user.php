<?php
include '../config/bootstrap.php';
include '../controllers/UserController.php';

$userController = new UserController();

$message = null;
if (isset($_POST['addStudent'])) {
    $message = $userController->addStudent($_POST['name'], $_POST['username'], $_POST['password'], $_POST['email'], $_POST['phoneNumber']);
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> Thêm học sinh </title>
    <link rel="stylesheet" href="../assets/style.css">
</head>

<body>
    <div class="container">
        <h2> Thêm học sinh </h2>
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
                <label> Email:</label><br />
                <input type="email" name="email">
            </div>
            <div class="form-group">
                <label> Số điện thoại:</label><br />
                <input type="text" name="phoneNumber">
            </div>
            <div class="form-group">
                <button type="submit" name="addStudent"> Thêm </button>
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
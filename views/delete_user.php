<?php
include '../config/bootstrap.php';
include "../controllers/UserController.php";

$userController = new UserController();
$info = $userController->viewUserProfile($_GET['id']);
if($info['role'] != 'student'){
    echo "Bạn không được quyền xóa người này!";
    exit();
}

$userController->deleteUser($_GET['id']);
header("Location: user_list.php")
?>
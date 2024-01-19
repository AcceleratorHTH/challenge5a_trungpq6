<?php
include '../config/bootstrap.php';
include "../controllers/MessageController.php";

$messageController = new MessageController();
$messageController->deleteMessage($_GET['id']);
header("Location: view_messages.php");
exit();

?>
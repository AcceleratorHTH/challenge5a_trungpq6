<?php
include '../config/bootstrap.php';
include "../controllers/MessageController.php";

$messageController = new MessageController();
$message = $messageController->viewMessageById($_GET['id']);

if(isset($_POST['update_message'])){
    $messageController->editMessage($_GET['id'], $_POST['message']);
    header("Location: view_messages.php");
    exit();
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> Sửa tin nhắn </title>
    <link rel="stylesheet" href="../assets/style.css">
</head>
<body>
    <div class="container">
        <h2> Sửa tin nhắn </h2>
        <form action="" method="POST" class="edit-message-form">
            <label for="message"> Tin nhắn: </label>
            <textarea name="message" id="message"><?php echo htmlspecialchars($message); ?></textarea>
            <button type="submit" name="update_message"> Cập nhật </button>
        </form>
    </div>
</body>
</html>
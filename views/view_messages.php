<?php
include '../config/bootstrap.php';
include "../controllers/UserController.php";
include "../controllers/MessageController.php";

$messageController = new MessageController();
$userController = new UserController();

$receivedMessage = $messageController->viewReceivedMessages($_SESSION['user_id']);
$sentMessage = $messageController->viewSentMessages($_SESSION['user_id']);

$senderIds = array_unique(array_column($receivedMessage, 'sender_id'));
$senders = [];
foreach ($senderIds as $senderId) {
    $senderInfo = $userController->viewUserProfile($senderId);
    if ($senderInfo) {
        $senders[$senderId] = $senderInfo['full_name'];
    }
}

$receiverIds = array_unique(array_column($sentMessage, 'receiver_id'));
$receivers = [];
foreach ($receiverIds as $receiverId) {
    $receiverInfo = $userController->viewUserProfile($receiverId);
    if ($receiverInfo) {
        $receivers[$receiverId] = $receiverInfo['full_name'];
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> Hộp thư </title>
    <link rel="stylesheet" href="../assets/style.css">
</head>

<body>
    <div class="message-container">
        <table class="message-table">
            <h2> Hộp thư đến </h2>
            <tr>
                <th>Người gửi</th>
                <th>Nội dung</th>
                <th>Thời gian</th>
            </tr>
            <?php foreach ($receivedMessage as $message) : ?>
                <tr>
                    <td><?php echo htmlspecialchars($senders[$message['sender_id']]); ?></td>
                    <td><?php echo htmlspecialchars($message['message_text']); ?></td>
                    <td><?php echo htmlspecialchars($message['updated_at']); ?></td>
                </tr>
            <?php endforeach; ?>
        </table>
        <table class="message-table">
            <h2> Thư đã gửi </h2>
            <tr>
                <th>Gửi tới</th>
                <th>Nội dung</th>
                <th>Thời gian</th>
                <th>Thao tác</th>
            </tr>
            <?php foreach ($sentMessage as $message) : ?>
                <tr>
                    <td><?php echo htmlspecialchars($receivers[$message['receiver_id']]); ?></td>
                    <td><?php echo htmlspecialchars($message['message_text']); ?></td>
                    <td><?php echo htmlspecialchars($message['updated_at']); ?></td>
                    <td>
                        <a href="edit_message.php?id=<?php echo $message['message_id']; ?>">Sửa</a>
                        <a href="delete_message.php?id=<?php echo $message['message_id']; ?>">Xóa</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </table>
    </div>
</body>

</html>
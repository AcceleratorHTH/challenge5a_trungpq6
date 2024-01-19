<?php
class Message
{
    private $db;

    public function __construct($db)
    {
        $this->db = $db;
    }

    public function saveMessage($data)
    {
        $senderId = (int)$data['sender_id'];
        $receiverId = (int)$data['receiver_id'];
        $message = $data['message'];

        $query = "INSERT INTO messages (sender_id, receiver_id, message_text) VALUES (?, ?, ?)";
        $stmt = mysqli_prepare($this->db, $query);
        mysqli_stmt_bind_param($stmt, 'iis', $senderId, $receiverId, $message);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_close($stmt);
    }

    public function editMessage($messageId, $messageData)
    {
        $query = "UPDATE messages SET message_text = ? WHERE message_id = ?";
        $stmt = mysqli_prepare($this->db, $query);
        mysqli_stmt_bind_param($stmt, 'si', $messageData, $messageId);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_close($stmt);
    }

    public function deleteMessage($messageId)
    {
        $query = "DELETE FROM messages WHERE message_id = ?";
        $stmt = mysqli_prepare($this->db, $query);
        mysqli_stmt_bind_param($stmt, 'i', $messageId);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_close($stmt);
    }

    public function getMessageById($messageId) {
        $query = "SELECT * from messages WHERE message_id = ?";
        $stmt = mysqli_prepare($this->db, $query);
        mysqli_stmt_bind_param($stmt, 'i', $messageId);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);

        return mysqli_fetch_assoc($result)['message_text'];
        
    }

    public function getMessagesByReceiver($receiverId) {
        $query = "SELECT * FROM messages WHERE receiver_id = ?";
        $stmt = mysqli_prepare($this->db, $query);
        mysqli_stmt_bind_param($stmt, 'i', $receiverId);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);

        $listMessage = array();
        while ($row = mysqli_fetch_assoc($result)) {
            $listMessage[] = $row;
        }

        return $listMessage;
    }

    public function getSentMessages($senderId) {
        $query = "SELECT * FROM messages WHERE sender_id = ?";
        $stmt = mysqli_prepare($this->db, $query);
        mysqli_stmt_bind_param($stmt, 'i', $senderId);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);

        $listMessage = array();
        while ($row = mysqli_fetch_assoc($result)) {
            $listMessage[] = $row;
        }

        return $listMessage;
    }
}

<?php

include '../models/Message.php';

class MessageController {

    private $messageModel;

    public function __construct()
    {
        include '../config/database.php';
        $this->messageModel = new Message($connect);
    }

    public function sendMessage($data) {
        $this->messageModel->saveMessage($data);
    }

    public function viewReceivedMessages($receiverId) {
        return $this->messageModel->getMessagesByReceiver($receiverId);
    }

    public function viewSentMessages($senderId) {
        return $this->messageModel->getSentMessages($senderId);
    }

    public function viewMessageById($messageId) {
        return $this->messageModel->getMessageById($messageId);
    }

    public function editMessage($messageId, $messageData){
        return $this->messageModel->editMessage($messageId, $messageData);
    }

    public function deleteMessage($messageId){
        return $this->messageModel->deleteMessage($messageId);
    }

}

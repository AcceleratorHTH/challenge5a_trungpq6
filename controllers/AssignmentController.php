<?php

include '../models/Assignment.php';

class AssignmentController
{
    private $assignmentModel;

    public function __construct()
    {
        include '../config/database.php';
        $this->assignmentModel = new Assignment($connect);
    }

    public function uploadAssignment()
    {
        $title = $_POST['title'];
        $description = $_POST['description'];
        $deadline = $_POST['deadline'];

        $filePath = $this->handleFileUpload($_FILES['file_path']);

        if ($filePath) {
            $this->assignmentModel->uploadAssignment($title, $description, $filePath, $deadline);
        } else {
            echo "Đã xảy ra lỗi";
            return null;
        }
    }

    public function listAssignments()
    {
        return $this->assignmentModel->getAssignments();
    }

    private function handleFileUpload($file)
    {
        if ($file['error'] === 0) {
            $targetDirectory = "../views/uploads/assignments/";
            $targetFile = $targetDirectory . basename($file['name']);
            $fileType = strtolower(pathinfo($targetFile, PATHINFO_EXTENSION));

            $allowedFileTypes = ['docx', 'doc', 'pdf' ,'txt'];

            if (!in_array($fileType, $allowedFileTypes)) {
                echo "Chỉ được phép upload file văn bản.";
                return null;
            }

            if (move_uploaded_file($file['tmp_name'], $targetFile)) {
                return $targetFile;
            } else {
                echo "Đã xảy ra lỗi khi tải file.";
            }
        } else {
            echo "Đã xảy ra lỗi với file được tải lên.";
        }
        return null;
    }
}

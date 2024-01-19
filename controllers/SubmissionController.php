<?php

include '../models/Submission.php';

class SubmissionController
{
    private $submissionModel;

    public function __construct()
    {
        include '../config/database.php';
        $this->submissionModel = new Submission($connect);
    }

    public function uploadSubmission() {
        $assignmentId = (int)$_GET['id'];
        $studentId = $_SESSION['user_id'];
        $filePath = $this->handleFileUpload($_FILES['file_path']);

        if ($filePath) {
            $this->submissionModel->uploadSubmission($assignmentId, $studentId, $filePath);
        } else {
            echo "Đã xảy ra lỗi";
            return null;
        }
    }

    public function listSubmissions() {
        $assignmentId = $_GET['id'];
        return $this->submissionModel->getSubmissionsByAssignment($assignmentId);
    }

    private function handleFileUpload($file)
    {
        if ($file['error'] === 0) {
            $targetDirectory = "../views/uploads/submissions/";
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
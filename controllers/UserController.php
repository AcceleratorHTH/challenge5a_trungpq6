<?php

include '../models/User.php';
include '../utils/Validate.php';
include '../utils/PasswordHandler.php';
class UserController
{
    private $userModel;

    public function __construct()
    {
        include '../config/database.php';
        $this->userModel = new User($connect);
    }

    public function login($username, $password)
    {
    
        $userInfo = $this->userModel->getUserByUsername($username);

        if (!$userInfo || !PasswordHandler::verifyPassword($password, $userInfo['password'])) {
            return "Tên đăng nhập hoặc mật khẩu không đúng!";
        } else {
            $_SESSION['logged'] = TRUE;
            $_SESSION['user_id'] = $userInfo['user_id'];
            $_SESSION['role'] = $userInfo['role'];
            header("Location: ../index.php");
            exit();
        }
    }

    public function register($name, $username, $password, $retypePassword, $email, $phoneNumber)
    {
        if ($password != $retypePassword) {
            return "Mật khẩu không trùng khớp!";
        } elseif (!Validate::validateUsername($username) || !Validate::validatePassword($password)) {
            return 'Tên đăng nhập hoặc mật khẩu không hợp lệ!';
        } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            return "Email không đúng định dạng!";
        } elseif (!Validate::validatePhoneNumber($phoneNumber)) {
            return "Số điện thoại không đúng định dạng!";
        } elseif ($this->userModel->checkUserExists($username, $email, $phoneNumber)) {
            return "Tên đăng nhập hoặc email hoặc số điện thoại đã tồn tại!";
        } else {
            $hashedPassword = PasswordHandler::hashPassword($password);
            if ($this->userModel->registerUser($username, $hashedPassword, $name, $email, $phoneNumber)) {
                return "Đăng ký thành công!";
            } else {
                return "Đã có lỗi xảy ra trong quá trình đăng ký, hãy thử lại sau!";
            }
        }
    }

    public function addStudent($name, $username, $password, $email, $phoneNumber)
    {
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            return "Email không đúng định dạng!";
        } elseif (!Validate::validatePhoneNumber($phoneNumber)) {
            return "Số điện thoại không đúng định dạng!";
        } elseif ($this->userModel->checkUserExists($username, $email, $phoneNumber)) {
            return "Tên đăng nhập hoặc email hoặc số điện thoại đã tồn tại!";
        } else {
            $hashedPassword = PasswordHandler::hashPassword($password);
            if ($this->userModel->registerUser($username, $hashedPassword, $name, $email, $phoneNumber)) {
                return "Đăng ký thành công!";
            } else {
                return "Đã có lỗi xảy ra trong quá trình đăng ký, hãy thử lại sau!";
            }
        }
    }

    public function viewUserList()
    {
        return $this->userModel->getUserList();
    }

    public function viewUserProfile($userId)
    {
        return $this->userModel->getUserById($userId);
    }

    public function editUser($userId, $newData)
    {
        $this->userModel->updateUser($userId, $newData);
    }

    public function changeUserPassword($userId, $oldPassword, $newPassword)
    {
        return $this->userModel->changeUserPassword($userId, $oldPassword, $newPassword);
    }

    public function updateAvatar($userId, $avatarPath)
    {
        $this->userModel->updateAvatar($userId, $avatarPath);
    }

    public function deleteUser($userId)
    {
        $this->userModel->deleteUser($userId);
    }

    private function handleFileUpload($file)
    {
        if ($file['error'] === 0) {
            $targetDirectory = "../views/uploads/avatars/";
            $targetFile = $targetDirectory . basename($file['name']);
            $fileType = strtolower(pathinfo($targetFile, PATHINFO_EXTENSION));

            $allowedFileTypes = ['jpg', 'jpeg', 'png', 'gif'];

            if (!in_array($fileType, $allowedFileTypes)) {
                echo "Chỉ được phép upload ảnh.";
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

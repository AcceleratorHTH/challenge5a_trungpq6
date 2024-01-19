<?php

class User
{
    private $db;

    public function __construct($db)
    {
        $this->db = $db;
    }

    public function updateUser($userId, $userData)
    {
        $email = $userData['email'];
        $phoneNumber = $userData['phone_number'];

        $query = "UPDATE users SET email = ?, phone_number = ? WHERE user_id = ?";
        $stmt = mysqli_prepare($this->db, $query);
        mysqli_stmt_bind_param($stmt, 'ssi', $email, $phoneNumber, $userId);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_close($stmt);
    }

    public function getUserList()
    {
        $query = "SELECT * FROM users";
        $stmt = mysqli_prepare($this->db, $query);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);

        $list = array();
        while ($row = mysqli_fetch_assoc($result)) {
            $list[] = $row;
        }
        mysqli_stmt_close($stmt);

        return $list;
    }

    public function getUserById($userId)
    {
        $query = "SELECT * FROM users WHERE user_id = ?";
        $stmt = mysqli_prepare($this->db, $query);
        mysqli_stmt_bind_param($stmt, 'i', $userId);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);
        $user = mysqli_fetch_assoc($result);
        mysqli_stmt_close($stmt);
        return $user;
    }

    public function changeUserPassword($userId, $oldPassword, $newPassword)
    {
        $query = "SELECT password FROM users WHERE user_id = ?";
        $stmt = mysqli_prepare($this->db, $query);
        mysqli_stmt_bind_param($stmt, 'i', $userId);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);
        $userPassword = mysqli_fetch_assoc($result)['password'];

        include '../utils/PasswordHandler.php';
        
        if(!PasswordHandler::verifyPassword($oldPassword, $userPassword)){
            return False;
        }

        $newPassword = PasswordHandler::hashPassword($newPassword);
        $updateQuery = 'UPDATE users SET password = ? WHERE user_id = ?';
        $updateStmt = mysqli_prepare($this->db, $updateQuery);
        mysqli_stmt_bind_param($updateStmt, 'si', $newPassword, $userId);
        mysqli_stmt_execute($updateStmt);
        mysqli_stmt_close($updateStmt);
        return True;
    }

    public function updateAvatar($userId, $avatarPath){
        $query = "UPDATE users SET avatar = ? WHERE user_id = ?";
        $stmt = mysqli_prepare($this->db, $query);
        mysqli_stmt_bind_param($stmt, 'si', $avatarPath, $userId);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_close($stmt);
    }

    public function deleteUser($userId){
        $query = "DELETE FROM users WHERE user_id = ?";
        $stmt = mysqli_prepare($this->db, $query);
        mysqli_stmt_bind_param($stmt, 'i', $userId);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_close($stmt);
    }

    public function getUserByUsername($username) {
        $query = 'SELECT user_id, password, role FROM users WHERE username = ?';
        $stmt = mysqli_prepare($this->db, $query);
        mysqli_stmt_bind_param($stmt, "s", $username);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);
        $info = mysqli_fetch_assoc($result);
        mysqli_stmt_close($stmt);
        return $info;
    }

    public function checkUserExists($username, $email, $phoneNumber) {
        $query = "SELECT * FROM users WHERE username = ? OR email = ? OR phone_number = ?";
        $stmt = mysqli_prepare($this->db, $query);
        mysqli_stmt_bind_param($stmt, "sss", $username, $email, $phoneNumber);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_store_result($stmt);
        $num_rows = mysqli_stmt_num_rows($stmt);
        mysqli_stmt_close($stmt);
        return $num_rows > 0;
    }

    public function registerUser($username, $hashedPassword, $name, $email, $phoneNumber) {
        $query = "INSERT INTO users (username, password, full_name, email, phone_number) VALUES (?, ?, ?, ?, ?)";
        $stmt = mysqli_prepare($this->db, $query);
        mysqli_stmt_bind_param($stmt, "sssss", $username, $hashedPassword, $name, $email, $phoneNumber);
        if (mysqli_stmt_execute($stmt)) {
            mysqli_stmt_close($stmt);
            return true;
        } else {
            mysqli_stmt_close($stmt);
            return false;
        }
    }
}

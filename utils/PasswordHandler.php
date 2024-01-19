<?php
include '../config/environment.php';

class PasswordHandler
{
    public static function hashPassword($password)
    {
        $pepper = $_ENV['PEPPER'];
        $pepperPassword = $password . $pepper;
        
        $password = password_hash($pepperPassword, PASSWORD_BCRYPT);

        return $password;
    }

    public static function verifyPassword($password, $storedPassword)
    {
        $pepper = $_ENV['PEPPER'];
        $pepperPassword = $password . $pepper;

        $check = password_verify($pepperPassword, $storedPassword);
        return $check;
    }
}

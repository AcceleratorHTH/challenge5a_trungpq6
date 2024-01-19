<?php

class Validate
{
    public static function validatePhoneNumber($phone)
    {
        $check = preg_match('/\b(84|0[3|5|7|8|9])+([0-9]{8,9})\b/', $phone);
        if (!$check) {
            return FALSE;
        }
        return TRUE;
    }

    public static function validateUsername($username)
    {
        $check = preg_match('/\b[a-zA-Z0-9]+\b/', $username);
        if (!$check) {
            return FALSE;
        }
        return TRUE;
    }

    public static function validatePassword($password)
    {
        $check = preg_match('/^(?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?=.*[a-zA-Z]).{8,}$/', $password);
        if (!$check) {
            return FALSE;
        }
        return TRUE;
    }
}

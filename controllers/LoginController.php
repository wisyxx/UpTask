<?php

namespace Controllers;

use MVC\Router;

class LoginController
{
    public static function login(Router $rotuer)
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        }

        $rotuer->render('auth/login', [
            'title' => 'Login'
        ]);
    }
    public static function logout(Router $rotuer)
    {
        session_start();

        $_SESSION = [];

        $rotuer->render('auth/login', []);
    }
    public static function register(Router $rotuer)
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        }

        $rotuer->render('auth/register', [
            'title' => 'Create account'
        ]);
    }
    public static function forgotPassword(Router $rotuer)
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        }

        $rotuer->render('auth/forgot', [
            'title' => 'Forgot password'
        ]);
    }
    public static function resetPassword(Router $rotuer)
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        }

        $rotuer->render('auth/reset', [
            'title' => 'Reset password'
        ]);
    }
    public static function message(Router $rotuer)
    {

        $rotuer->render('auth/message', []);
    }
    public static function confirmAccount(Router $rotuer)
    {

        $rotuer->render('auth/confirm', []);
    }
}

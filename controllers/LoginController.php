<?php

namespace Controllers;

use MVC\Router;

class LoginController
{
    public static function login(Router $rotuer)
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            
        }

        $rotuer->render('auth/login', []);
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

        $rotuer->render('auth/login', []);
    }
    public static function forgotPassword(Router $rotuer)
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        }

        $rotuer->render('auth/login', []);
    }
    public static function message(Router $rotuer)
    {

        $rotuer->render('auth/login', []);
    }
    public static function confirmAccount(Router $rotuer)
    {
        
        $rotuer->render('auth/login', []);
    }
}
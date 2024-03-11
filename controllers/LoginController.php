<?php

namespace Controllers;

use Classes\Email;
use Model\User;
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
        $user = new User;

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $user->sync($_POST);

            $alerts = $user->validateNewAccount();

            if (empty($alerts)) {

                $userExists = User::where('email', $user->email);

                if ($userExists) {
                    User::setAlert('error', 'It seems like the user already has an account');
                    $alerts = User::getAlerts();
                } else {
                    $user->hashPasword();
                    unset($user->password1); // Delete atribute "password1"
                    $user->generateToken();
                    $user->verified = 0; // Set verified status to not verified
                    $result = $user->save();

                    $email = new Email($user->email, $user->name, $user->token);
                    $email->sendConfirmation();
                    
                    if ($result) {
                        header("Location: /message");
                    }
                }
            }
        }

        $alerts = User::getAlerts();
        $rotuer->render('auth/register', [
            'title' => 'Create account',
            'user' => $user,
            'alerts' => $alerts
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

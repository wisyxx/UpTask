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
            $user = new User($_POST);
            $alerts = $user->validateEmail();
            
            if (empty($alerts)) {
                $user = $user::where('email', $user->email);

                if ($user && $user->verified) {
                    $user->generateToken();
                    unset($user->password1);
                    $user->save();

                    $email = new Email($user->email, $user->name, $user->token);
                    $email->sendPasswordResetInstructions();
                    User::setAlert('succes', 'We\'ve sent the instructions, check your inbox!');
                } else {
                    User::setAlert('error', 'The user does not exist or is not verified');
                }
            }
        }

        $alerts = User::getAlerts();
        $rotuer->render('auth/forgot', [
            'title' => 'Forgot password',
            'alerts' => $alerts
        ]);
    }
    public static function resetPassword(Router $rotuer)
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $user = new User($_POST);

            $user->validateEmail();
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
        $token = s($_GET['token']);

        if (!$token) header('Location: /');

        $user = User::where('token', $token);

        if (empty($user)) {
            User::setAlert('error', 'Invalid token!');
        } else {
            // Confirm account
            $user->verified = 1;
            $user->token = '';
            unset($user->password1); // Delete atribute "password1"
            $user->save();

            User::setAlert('succes', 'Account verified!');
        }

        $alerts = User::getAlerts();
        $rotuer->render('auth/confirm', [
            'alerts' => $alerts
        ]);
    }
}

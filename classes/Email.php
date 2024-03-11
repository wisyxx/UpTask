<?php

namespace Classes;

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\Test\PHPMailer\SetFromTest;

class Email
{
    protected $email;
    protected $name;
    protected $token;

    public function __construct($email, $name, $token)
    {
        $this->email = $email;
        $this->name = $name;
        $this->token = $token;
    }

    public function sendConfirmation()
    {
        $mail = new PHPMailer();
        $mail->isSMTP();
        $mail->Host = 'sandbox.smtp.mailtrap.io';
        $mail->SMTPAuth = true;
        $mail->Port = 2525;
        $mail->Username = '35ba6cecf041f5';
        $mail->Password = 'e592a46b44fab9';
        
        $mail->setFrom('accounts@uptask.com');
        $mail->addAddress('accounts@uptask.com', 'uptask.com');

        $mail->Subject = 'Verify your account';

        $mail->isHTML();
        $mail->CharSet = 'UTF-8';

        $content = '<html>';
        $content .= "<p><strong>Hello, " . $this->name . "</strong><br>To finish the account 
        creation process verify your account clicking the following link</p>";
        $content .= "<p><a href='http://localhost:3000/verify?token=" .
            $this->token . "'>Verify account</a></p>";
        $content .= "If this wasn't you just ignore the message";
        $content .= '</html>';
        
        $mail->Body = $content;
        $mail->send();
    }
}

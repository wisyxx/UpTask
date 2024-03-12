<?php

namespace Model;

class User extends ActiveRecord
{
    protected static $table = 'users';
    protected static $DBColumns = ['id', 'name', 'email', 'password', 'token', 'verified'];

    public $id;
    public $name;
    public $email;
    public $password;
    public $password1;
    public $token;
    public $verified;

    public function __construct($args = [])
    {
        $this->id = $args['id'] ?? null;
        $this->name = $args['name'] ?? '';
        $this->email = $args['email'] ?? '';
        $this->password = $args['password'] ?? '';
        $this->password1 = $args['password1'] ?? '';
        $this->token = $args['token'] ?? '';
        $this->verified = $args['verified'] ?? '';
    }

    public function validateNewAccount()
    {
        if (!$this->name) {
            self::$alerts['error'][] = 'You must write your name';
        }
        if (!$this->email) {
            self::$alerts['error'][] = 'You must write your email';
        }
        if (!$this->password) {
            self::$alerts['error'][] = 'You must write a valid password';
        }
        if (strlen($this->password) < 8) {
            self::$alerts['error'][] = 'The password must have at least 8 characters';
        }
        if ($this->password !== $this->password1) {
            self::$alerts['error'][] = 'The passwords do not match';
        }

        return self::$alerts;
    }
    public function hashPasword()
    {
        $this->password = password_hash($this->password, PASSWORD_BCRYPT);
    }
    public function generateToken()
    {
        $this->token = uniqid();
    }
    public function validateEmail()
    {
        if (!$this->email) {
            self::$alerts['error'][] = 'You must write your email';
        }
        if ($this->email && !filter_var($this->email, FILTER_VALIDATE_EMAIL)) {
            self::$alerts['error'][] = 'Invalid email';
        }
        return self::$alerts;
    }
}
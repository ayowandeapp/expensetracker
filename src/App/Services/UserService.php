<?php


declare(strict_types=1);

namespace App\Services;

use Framework\Database;
use Framework\Exceptions\ValidationException;
use Framework\Rules\EmailRule;
use Framework\Rules\RequireRule;
use Framework\Validator;

class UserService
{

    private Validator $validator;

    public function __construct(private Database $db)
    {
    }

    public function isEmailTaken(string $email)
    {
        $emailCount = $this->db->query("SELECT COUNT(*) FROM users WHERE email = :email", ['email' => $email])->count();

        if ($emailCount > 0) {
            throw new ValidationException(['email' => 'Email taken']);
        }
    }

    public function create(array $formData)
    {
        $pass = password_hash($formData['password'], PASSWORD_BCRYPT, ['cost' => 13]);
        $this->db->query(
            "INSERT INTO users(email, password, age, country, social_media_url) 
            VALUES (:email, :password, :age, :country, :url)",
            [
                'email' => $formData['email'],
                'password' => $pass,
                'age' => $formData['age'],
                'country' => $formData['country'],
                'url' => $formData['social'],
            ]
        );

        session_regenerate_id();

        $_SESSION['user'] = $this->db->id();
    }
    public function login(array $formData)
    {
        $user = $this->db->query(
            "SELECT * FROM users WHERE email = :email",
            [
                'email' => $formData['email'],
            ]
        )->find();

        $passwordMatch = password_verify(
            $formData['password'],
            $user['password'] ?? ''
        );

        if (!$user || !$passwordMatch) {
            throw new ValidationException([
                'password' => ['Invalid credentials']
            ]);
        }

        session_regenerate_id();

        $_SESSION['user'] = $user['id'];
    }

    public function logout()
    {
        unset($_SESSION['user']);

        session_regenerate_id();
    }
}

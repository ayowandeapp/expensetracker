<?php


declare(strict_types=1);

namespace App\Services;

use Framework\Rules\EmailRule;
use Framework\Rules\RequireRule;
use Framework\Validator;

class ValidatorService
{

    private Validator $validator;

    public function __construct()
    {
        $this->validator = new Validator();

        $this->validator->add('required', new RequireRule());
        $this->validator->add('email', new EmailRule());
    }

    public function validateRegister(array $formData)
    {
        $this->validator->validate($formData, [
            'email' => ['required', 'email'],
            'age' => ['required'],
            'country' => ['required'],
            'social' => ['required'],
            'confirm_password' => ['required'],
            'password' => ['required'],
            'tsc' => ['required'],

        ]);
    }

    public function validateLogin(array $formData)
    {
        $this->validator->validate($formData, [
            'email' => ['required', 'email'],
            'password' => ['required'],

        ]);
    }
}

<?php

declare(strict_types=1);

namespace App\Controllers;

use Framework\TemplateEngine;
use App\Services\{ValidatorService, UserService};
use Google\Holidays;

class UserController
{
    public function __construct(
        private TemplateEngine $view,
        private ValidatorService $validatorService,
        private UserService $userService
    ) {
    }

    public function viewProfile()
    {
        if ($_SESSION['user']) {
            $userDetail = $this->userService->getUserDetails();

            if (!$userDetail) redirectTo('/');

            echo $this->view->render("user/view_profile.php", [
                'user_detail' => $userDetail
            ]);
        } else {
            redirectTo('/');
        }
    }
    public function editProfile()
    {
        if ($_SERVER['REQUEST_METHOD'] == "POST") {

            if ($_SESSION['user']) {
                $userDetail = $this->userService->getUserDetails();

                if (!$userDetail) redirectTo('/');

                $this->validatorService->validateProfile($_POST);
                $this->userService->updateProfile($_POST);
                //add success session, delete after 5 seconds

                redirectTo($_SERVER['HTTP_REFERER']);
            } else {
                redirectTo('/');
            }
        } elseif ($_SERVER['REQUEST_METHOD'] == "GET") {

            if ($_SESSION['user']) {
                $userDetail = $this->userService->getUserDetails();

                if (!$userDetail) redirectTo('/');

                echo $this->view->render("user/edit.php", [
                    'user_detail' => $userDetail
                ]);
            } else {
                redirectTo('/');
            }
        }
    }
}

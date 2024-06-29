<?php


declare(strict_types=1);


namespace App\Controllers;

use App\Config\Paths;
use App\Services\TransactionService;
use App\Services\UserService;
use Framework\TemplateEngine;
use Google\Holidays;

class HomeController
{

    public function __construct(
        private TemplateEngine $view,
        private TransactionService $transactionService,
        private UserService $userService
    ) {
    }

    public function home()
    {
        try {
            $APIKEY = 'AIzaSycse4QVD0A'; // your key
            $end_date = date('Y-m-d', strtotime('+1 year'));
            $holiday = new Holidays();
            $holidays = $holiday->withApiKey($APIKEY)
                ->to($end_date)
                ->inCountry('NG')
                ->withMinimalOutput()
                ->list();

            echo $this->view->render('user/dashboard.php', [
                'holidays' => $holidays
            ]);
        } catch (\Exception $e) {
            error_log($e->getMessage());
            echo $this->view->render('user/dashboard.php', [
                'holidays' => []
            ]);
            //throw $th;
        }
        // [$transactions, $count] = $this->transactionService->getUserTransactions(
        //     $length,
        //     $offset
        // );
        // $lastPage = ceil($count / $length);

        // echo $this->view->render('/index.php', [
        //     'title' => 'Home',
        //     'transactions' => $transactions,
        //     'currentPage' => $page,
        //     'previous' => http_build_query(['p' => $page - 1, 's' => $search]),
        //     'lastPage' => $lastPage,
        //     'next' => http_build_query(['p' => $page + 1, 's' => $search]),
        // ]);
    }
    public function viewTransaction()
    {
        // redirectTo('/view_profile');

        // $page = $_GET['p'] ?? 1;
        // $page = (int) $page;
        // $length = 3;
        // $offset = ($page - 1) * $length;
        // $search = $_GET['s'] ?? null;

        // [$transactions, $count] = $this->transactionService->getUserTransactions(
        //     $length,
        //     $offset
        // );
        // $lastPage = ceil($count / $length);

        // echo $this->view->render('/index.php', [
        //     'title' => 'Home',
        //     'transactions' => $transactions,
        //     'currentPage' => $page,
        //     'previous' => http_build_query(['p' => $page - 1, 's' => $search]),
        //     'lastPage' => $lastPage,
        //     'next' => http_build_query(['p' => $page + 1, 's' => $search]),
        // ]);
    }
}

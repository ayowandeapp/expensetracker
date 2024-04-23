<?php


declare(strict_types=1);


namespace App\Controllers;

use App\Config\Paths;
use App\Services\TransactionService;
use Framework\TemplateEngine;

class HomeController
{

    public function __construct(private TemplateEngine $view, private TransactionService $transactionService)
    {
    }

    public function home()
    {
        $page = $_GET['p'] ?? 1;
        $page = (int) $page;
        $length = 3;
        $offset = ($page - 1) * $length;
        $search = $_GET['s'] ?? null;

        [$transactions, $count] = $this->transactionService->getUserTransactions(
            $length,
            $offset
        );
        $lastPage = ceil($count / $length);

        echo $this->view->render('/index.php', [
            'title' => 'Home',
            'transactions' => $transactions,
            'currentPage' => $page,
            'previous' => http_build_query(['p' => $page - 1, 's' => $search]),
            'lastPage' => $lastPage,
            'next' => http_build_query(['p' => $page + 1, 's' => $search]),
        ]);
    }
}

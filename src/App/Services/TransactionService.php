<?php


declare(strict_types=1);

namespace App\Services;

use Framework\Database;

class TransactionService
{

    public function __construct(private Database $db)
    {
    }

    public function create(array $formData)
    {
        $this->db->query(
            "INSERT INTO transactions(user_id, description, amount, date) 
            VALUES(:user_id, :description, :amount, :date)",
            [
                'user_id' => $_SESSION['user'],
                'description' => $formData['description'],
                'amount' => $formData['amount'],
                'date' => $formData['date']
            ]
        );
    }

    public function getUserTransactions(int $length, int $offset)
    {
        $searchTerm = addcslashes($_GET['s'] ?? '', '%');
        $params = [
            'user_id' => $_SESSION['user'],
            'search_term' => "%{$searchTerm}%",
        ];

        $transactions =  $this->db->query(
            "SELECT * FROM transactions 
                WHERE user_id = :user_id 
                AND description LIKE :search_term
                LIMIT {$offset}, {$length}",
            $params
        )->all();
        $transactionCount = $this->db->query(
            "SELECT COUNT(*) FROM transactions 
                WHERE user_id = :user_id 
                AND description LIKE :search_term",
            $params
        )->count();
        return [$transactions, $transactionCount];
    }
    public function getUserTransaction($id)
    {
        $params = [
            'user_id' => $_SESSION['user'],
            'id' => $id,
        ];

        $transaction =  $this->db->query(
            "SELECT *, DATE_FORMAT(date, '%Y-%m-%d') as formatted_date FROM transactions 
                WHERE user_id = :user_id 
                -- AND description LIKE :search_term
                AND id = :id
                ",
            $params
        )->find();
        return $transaction;
    }

    public function update(array $formData, int $id)
    {
        $params = [
            'user_id' => $_SESSION['user'],
            'id' => $id,
            'description' => $formData['description'],
            'amount' => $formData['amount'],
            'date' => $formData['date'],
        ];
        $this->db->query(
            "UPDATE transactions 
                SET description = :description,
                amount = :amount,
                date = :date
                WHERE user_id = :user_id 
                AND id = :id
                ",
            $params
        );
    }

    public function delete(int $id)
    {
        $params = [
            'user_id' => $_SESSION['user'],
            'id' => $id
        ];
        $this->db->query(
            "DELETE FROM transactions 
                WHERE user_id = :user_id 
                AND id = :id
                ",
            $params
        );
    }
}

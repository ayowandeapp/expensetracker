<?php

declare(strict_types=1);

namespace Framework;

use PDO;

class Database
{
    public PDO $connection;

    public function __construct(string $driver, array $config, string $username, string $password)
    {

        // $driver = 'mysql';
        $config = http_build_query(data: $config, arg_separator: ';');

        $dsn = "{$driver}:{$config}";
        // $username = 'root';
        // $password = '';

        try {
            $this->connection = new PDO($dsn, $username, $password);
        } catch (\PDOException $e) {
            // throw $e;
            die('unable to connect to database');
        }
    }
}

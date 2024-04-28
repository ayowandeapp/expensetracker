<?php

use Framework\Database;

include __DIR__ . '/src/Framework/Database.php';


$db = new Database('mysql', [
    'host' => 'db',
    'port' => 3306,
    'dbname' => 'phptest'
], 'root', 'root');

// $db = new Database('mysql', [
//     'host' => env('DB_HOST', '127.0.0.1'),
//     'port' => env('DB_PORT', '3306'),
//     'dbname' => env('DB_NAME', 'phptest'),
// ], env('DB_USER', 'root'), env('DB_PASS', 'root'));


$sqlFile = file_get_contents("./database.sql");

$db->connection->query($sqlFile);

// try {
//     //code...
//     $db->connection->beginTransaction();



//     $query = "SELECT * FROM products";

//     $stmt = $db->connection->prepare($query);

//     $stmt->execute();
//     var_dump($stmt->fetchAll(PDO::FETCH_OBJ));

//     $db->connection->commit();
// } catch (Exception $th) {
//     if ($db->connection->inTransaction()) {
//         $db->connection->rollBack();
//     }

//     echo "Transaction Failed!";
// }


// echo 'connected';

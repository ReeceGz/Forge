<?php
namespace App\Models;

use App\Database\Connection;
use PDO;

class Item
{
    public static function all(): array
    {
        $pdo = Connection::get();
        $stmt = $pdo->query('SELECT * FROM items ORDER BY id ASC');
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}

<?php
namespace App\Models;

use App\Database\Connection;
use PDO;

class Item
{
    public static function all(): array
    {
        $pdo = Connection::get();
        $stmt = $pdo->query('SELECT item_id AS id, catalog_name, cost_credits AS cost FROM catalog_items ORDER BY item_id ASC');
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}

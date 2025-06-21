<?php
namespace App\Database;

use PDO;

class Connection
{
    private static ?PDO $pdo = null;

    public static function get(): PDO
    {
        if (self::$pdo === null) {
            $dsn = $_ENV['DB_DSN'] ?? self::buildMysqlDsn();
            $user = $_ENV['DB_USER'] ?? ($_ENV['MYSQL_USER'] ?? 'root');
            $pass = $_ENV['DB_PASS'] ?? ($_ENV['MYSQL_PASSWORD'] ?? '');
            self::$pdo = new PDO($dsn, $user, $pass, [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]);
        }
        return self::$pdo;
    }

    private static function buildMysqlDsn(): string
    {
        $host = $_ENV['DB_HOST'] ?? ($_ENV['MYSQL_HOST'] ?? 'localhost');
        $port = $_ENV['DB_PORT'] ?? ($_ENV['MYSQL_PORT'] ?? '3306');
        $db   = $_ENV['DB_NAME'] ?? ($_ENV['MYSQL_DATABASE'] ?? 'arcturus');
        return "mysql:host={$host};port={$port};dbname={$db};charset=utf8mb4";
    }
}

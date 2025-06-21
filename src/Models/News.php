<?php
namespace App\Models;

use App\Database\Connection;
use PDO;

class News
{
    public int $id;
    public string $title;
    public string $body;

    public static function all(): array
    {
        $pdo = Connection::get();
        $stmt = $pdo->query('SELECT * FROM news ORDER BY id DESC');
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public static function create(string $title, string $body): self
    {
        $pdo = Connection::get();
        $stmt = $pdo->prepare('INSERT INTO news (title, body) VALUES (?, ?)');
        $stmt->execute([$title, $body]);
        $id = (int)$pdo->lastInsertId();
        return self::find($id);
    }

    public static function find(int $id): ?self
    {
        $pdo = Connection::get();
        $stmt = $pdo->prepare('SELECT * FROM news WHERE id = ?');
        $stmt->execute([$id]);
        $data = $stmt->fetch(PDO::FETCH_ASSOC);
        if (!$data) return null;
        $news = new self();
        $news->id = $data['id'];
        $news->title = $data['title'];
        $news->body = $data['body'];
        return $news;
    }
}

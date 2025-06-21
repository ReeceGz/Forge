<?php
namespace App\Models;

use App\Database\Connection;
use PDO;

class User
{
    public int $id;
    public string $username;
    public string $password;
    public string $email;

    public static function create(string $username, string $password, string $email): self
    {
        $pdo = Connection::get();
        $stmt = $pdo->prepare('INSERT INTO users (username, password, email) VALUES (?, ?, ?)');
        $hash = password_hash($password, PASSWORD_BCRYPT);
        $stmt->execute([$username, $hash, $email]);
        $id = (int)$pdo->lastInsertId();
        return self::find($id);
    }

    public static function find(int $id): ?self
    {
        $pdo = Connection::get();
        $stmt = $pdo->prepare('SELECT * FROM users WHERE id = ?');
        $stmt->execute([$id]);
        $data = $stmt->fetch(PDO::FETCH_ASSOC);
        if (!$data) return null;
        $user = new self();
        $user->id = $data['id'];
        $user->username = $data['username'];
        $user->password = $data['password'];
        $user->email = $data['email'];
        return $user;
    }

    public static function findByUsername(string $username): ?self
    {
        $pdo = Connection::get();
        $stmt = $pdo->prepare('SELECT * FROM users WHERE username = ?');
        $stmt->execute([$username]);
        $data = $stmt->fetch(PDO::FETCH_ASSOC);
        if (!$data) return null;
        $user = new self();
        $user->id = $data['id'];
        $user->username = $data['username'];
        $user->password = $data['password'];
        $user->email = $data['email'];
        return $user;
    }
}

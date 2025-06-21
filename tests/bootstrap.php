<?php
require __DIR__ . '/../vendor/autoload.php';

use App\Database\Connection;

$pdo = Connection::get();

$pdo->exec('CREATE TABLE IF NOT EXISTS users (id INTEGER PRIMARY KEY AUTOINCREMENT, username TEXT, password TEXT, email TEXT)');
$pdo->exec('CREATE TABLE IF NOT EXISTS news (id INTEGER PRIMARY KEY AUTOINCREMENT, title TEXT, body TEXT)');
$pdo->exec('CREATE TABLE IF NOT EXISTS items (id INTEGER PRIMARY KEY AUTOINCREMENT, name TEXT, cost INTEGER)');

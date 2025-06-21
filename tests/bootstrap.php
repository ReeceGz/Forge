<?php

require __DIR__ . '/../vendor/autoload.php';

use App\Database\Connection;

putenv('DB_DSN=sqlite::memory:');
putenv('DB_USER=');
putenv('DB_PASS=');
$_ENV['DB_DSN'] = 'sqlite::memory:';
$_ENV['DB_USER'] = '';
$_ENV['DB_PASS'] = '';
$pdo = Connection::get();

$pdo->exec('CREATE TABLE IF NOT EXISTS users (id INTEGER PRIMARY KEY AUTOINCREMENT, username TEXT, password TEXT, mail TEXT)');
$pdo->exec('CREATE TABLE IF NOT EXISTS cms_news (id INTEGER PRIMARY KEY AUTOINCREMENT, title TEXT, body TEXT)');
$pdo->exec('CREATE TABLE IF NOT EXISTS catalog_items (item_id INTEGER PRIMARY KEY AUTOINCREMENT, catalog_name TEXT, cost_credits INTEGER)');

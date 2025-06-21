# Habbo Retro Headless API

This project provides a lightweight headless API for a Habbo retro CMS built with the Slim Framework. It includes basic endpoints for user registration and login, news management and a simple catalog. The default configuration now targets a MySQL database compatible with the **Arcturus Morningstar** schema.

## Setup

1. Install dependencies:
   ```bash
   composer install
   ```
2. Copy `.env.example` to `.env` and adjust database credentials if needed. By default the API will try to connect to a MySQL server on `localhost` using database `arcturus`:
   ```env
   DB_HOST=localhost
   DB_PORT=3306
   DB_NAME=arcturus
   DB_USER=root
   DB_PASS=
   ```
3. Run the development server:
   ```bash
   php -S localhost:8080 -t public
   ```
4. Run tests:
   ```bash
   vendor/bin/phpunit
   ```

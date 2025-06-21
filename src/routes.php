<?php
use Slim\App;
use App\Controllers\UserController;
use App\Controllers\NewsController;
use App\Controllers\CatalogController;

return function (App $app) {
    $app->get('/ping', function ($request, $response) {
        $response->getBody()->write('pong');
        return $response;
    });

    $app->post('/register', [UserController::class, 'register']);
    $app->post('/login', [UserController::class, 'login']);
    $app->get('/user/{id}', [UserController::class, 'show']);

    $app->get('/news', [NewsController::class, 'index']);
    $app->post('/news', [NewsController::class, 'create']);
    $app->get('/news/{id}', [NewsController::class, 'show']);

    $app->get('/catalog/items', [CatalogController::class, 'items']);
};

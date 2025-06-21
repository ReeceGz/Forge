<?php
namespace App\Controllers;

use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Message\ResponseInterface as Response;
use App\Models\News;

class NewsController
{
    public function index(Request $request, Response $response): Response
    {
        $news = News::all();
        $response->getBody()->write(json_encode($news));
        return $response->withHeader('Content-Type', 'application/json');
    }

    public function create(Request $request, Response $response): Response
    {
        $data = $request->getParsedBody();
        $news = News::create($data['title'], $data['body']);
        $response->getBody()->write(json_encode(['id' => $news->id]));
        return $response->withHeader('Content-Type', 'application/json');
    }

    public function show(Request $request, Response $response, array $args): Response
    {
        $news = News::find((int)$args['id']);
        if (!$news) {
            $response->getBody()->write(json_encode(['error' => 'Not found']));
            return $response->withStatus(404)->withHeader('Content-Type', 'application/json');
        }
        $response->getBody()->write(json_encode(['id' => $news->id, 'title' => $news->title, 'body' => $news->body]));
        return $response->withHeader('Content-Type', 'application/json');
    }
}

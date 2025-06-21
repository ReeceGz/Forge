<?php
namespace App\Controllers;

use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Message\ResponseInterface as Response;
use App\Models\User;

class UserController
{
    public function register(Request $request, Response $response): Response
    {
        $data = $request->getParsedBody();
        $user = User::create($data['username'], $data['password'], $data['email']);
        $payload = json_encode(['id' => $user->id, 'username' => $user->username]);
        $response->getBody()->write($payload);
        return $response->withHeader('Content-Type', 'application/json');
    }

    public function login(Request $request, Response $response): Response
    {
        $data = $request->getParsedBody();
        $user = User::findByUsername($data['username']);
        if (!$user || !password_verify($data['password'], $user->password)) {
            $response->getBody()->write(json_encode(['error' => 'Invalid credentials']));
            return $response->withStatus(401)->withHeader('Content-Type', 'application/json');
        }
        $payload = json_encode(['id' => $user->id, 'username' => $user->username]);
        $response->getBody()->write($payload);
        return $response->withHeader('Content-Type', 'application/json');
    }

    public function show(Request $request, Response $response, array $args): Response
    {
        $user = User::find((int)$args['id']);
        if (!$user) {
            $response->getBody()->write(json_encode(['error' => 'User not found']));
            return $response->withStatus(404)->withHeader('Content-Type', 'application/json');
        }
        $payload = json_encode(['id' => $user->id, 'username' => $user->username, 'email' => $user->email]);
        $response->getBody()->write($payload);
        return $response->withHeader('Content-Type', 'application/json');
    }
}

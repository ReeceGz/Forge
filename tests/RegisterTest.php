<?php
use PHPUnit\Framework\TestCase;
use Slim\Factory\AppFactory;
use DI\Container;

class RegisterTest extends TestCase
{
    protected function setUp(): void
    {
        require __DIR__ . '/bootstrap.php';
        $container = new Container();
        AppFactory::setContainer($container);
        $app = AppFactory::create();
        (require __DIR__ . '/../src/routes.php')($app);
        $this->app = $app;
    }

    public function testRegisterCreatesUser()
    {
        $data = ['username' => 'testuser', 'password' => 'secret', 'email' => 'test@example.com'];
        $request = (new \Slim\Psr7\Factory\ServerRequestFactory())->createServerRequest('POST', '/register');
        $request = $request->withParsedBody($data);
        $response = $this->app->handle($request);
        $body = json_decode((string)$response->getBody(), true);
        $this->assertArrayHasKey('id', $body);
        $this->assertSame('testuser', $body['username']);
    }
}

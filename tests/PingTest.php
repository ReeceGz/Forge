<?php
use PHPUnit\Framework\TestCase;
use Slim\Factory\AppFactory;
use DI\Container;

class PingTest extends TestCase
{
    protected function setUp(): void
    {
        $container = new Container();
        AppFactory::setContainer($container);
        $app = AppFactory::create();
        (require __DIR__ . '/../src/routes.php')($app);
        $this->app = $app;
    }

    public function testPing()
    {
        $request = (new \Slim\Psr7\Factory\ServerRequestFactory())->createServerRequest('GET', '/ping');
        $response = $this->app->handle($request);
        $this->assertSame('pong', (string)$response->getBody());
    }
}

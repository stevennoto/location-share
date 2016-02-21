<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
    require __DIR__ . '/vendor/autoload.php';

    use \Psr\Http\Message\ServerRequestInterface as Request;
    use \Psr\Http\Message\ResponseInterface as Response;

    $app = new \Slim\App;
    
    // Samples
    $app->get('/', function (Request $request, Response $response) {
        $response->getBody()->write("Hello world");
        return $response;
    });
    $app->get('/hello/{name}', function (Request $request, Response $response) {
        $name = $request->getAttribute('name');
        $response->getBody()->write("Hello, $name");
        return $response;
    });
    
    // Prototypes
    $app->get('/api/locations/{token}', function (Request $request, Response $response) {
        $token = $request->getAttribute('token');
        $response->getBody()->write("You asked to get location $token");
        return $response;
    });
    $app->post('/api/locations/', function (Request $request, Response $response) {
        $token = bin2hex(openssl_random_pseudo_bytes(16));
        $tokenlength = strlen($token); // 32
        $response->getBody()->write("You did a post, here's a token: $token");
        return $response;
    });
//    $app->config('debug', true);
    $app->run();
?>

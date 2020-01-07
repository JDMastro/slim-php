<?php
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Slim\Factory\AppFactory;

require __DIR__ . '/../vendor/autoload.php';

// Instantiate App
$app = AppFactory::create();

// Add error middleware
$app->addErrorMiddleware(true, true, true);

// Add routes
$app->get('/', function (Request $request, Response $response) {
    $response->getBody()->write('<a href="/hello/world">Try /hello/world</a>');
    return $response;
});

$app->post('/login', function (Request $request, Response $response, $args) {
    $correo = $request->getParam('correo');
    $pass = $request->getParam('password');

    $usuarios = array(
        array('Auth' => true ),
        array('nombre' => 'Jaime', 'apellidos'=> 'Mastrodomenico', 'telefono' => '2929292929929')
    );

    $error = array(
        array('Auth' => false ),
        array('message' => 'Credenciales invalidas')
    );
    if($correo == 'jmastro@hotmail.com' && $pass == '123456'){
        return $response->withJson($usuarios);
    }else{
        return $response->withJson($error);
    }
});

$app->run();
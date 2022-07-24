<?php

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use persistDataApi\Controller\DataPersistsController;

$configuration = [
    'settings' => [
        'displayErrorDetails' => true,
    ],
];
$c = new \Slim\Container($configuration);
$app = new \Slim\App($c);

$app->get('/', DataPersistsController::class . ':index');

$app->get('/data/add', DataPersistsController::class . ':add');

$app->get('/data/view', function (Request $request, Response $response, $args) {
    return $response->getBody()->write('hello');
});
$app->run();

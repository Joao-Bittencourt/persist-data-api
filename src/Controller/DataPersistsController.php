<?php

namespace persistDataApi\Controller;

use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

class DataPersistsController {


    public function index(ServerRequestInterface $request, ResponseInterface $response, array $args) {
        $oLaboratory = new \persistDataApi\model\Data();
	$users = $oLaboratory->getUsers();
	$app->contentType('application/json');
	echo json_encode($users);
    }
    
    public function add(ServerRequestInterface $request, ResponseInterface $response, array $args) {
        return $response->getBody()->write('dentro do add');
    }

    //    public function view($param) {}
}

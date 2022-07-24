<?php

namespace persistDataApi\Controller;

use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use persistDataApi\model\Data;

class DataPersistsController {

    public function index(ServerRequestInterface $request, ResponseInterface $response, array $args) {
        $data = new Data();
        $datas = $data->getDatas();

        echo json_encode($datas);
    }

    public function add(ServerRequestInterface $request, ResponseInterface $response, array $args) {

        if ($request->isGet()) {
            
            $params = $request->getQueryParams();
            $Data = new \Data();

            $data = array('message' => 'Sucess!', 'code' => 1);
            if (!$Data->insertData($params)) {
                $data = array('message' => $Data->errors, 'code' => 0);
            }

            return $response->withJson($data, 201);
        }
    }

    //    public function view($param) {}
}

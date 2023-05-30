<?php

declare(strict_types=1);

namespace src\controllers;

use src\core\View;
use src\core\Controller;
use Laminas\Diactoros\Response;
use src\traits\Validate;
use src\traits\Url;
use src\traits\responseJson;
use src\classes\Distance;
use src\classes\Coordinates;

class dashboardController extends Controller
{
    use Validate, Url, responseJson;

    public View $view; // Responsavel por renderizar a view home
    public $rider;

    public function __construct()
    {
        $this->view = new View(__DIR__, get_class($this));
    }

    // Renderiza a view de dashboard
    public function dashboard(): Response
    {
        // Dados para renderização no template
        $data = $this->dataTheme('Dashboard');
        $data += [
            'url_maxDistance' => url('maxDistance'),
            'url_search_riders' => url('searchRiders'),
            'url_getCoordinates' => url('coordinates')
        ];

        $this->view->addData($data, '../theme/theme');
        $this->view->addData($data, '../scripts/scripts');
        $this->view->addData($data, '../scripts/getCoordinates');
        $this->view->addData($data, '../scripts/getDistances');

        $response = new Response();
        $response->getBody()->write(
            $this->view->render(__FUNCTION__, [])
        );

        return $response;
    }

    public function coordinates(): Response
    {

        // Obtendo dados da requisição
        $request = (object)getRequest()->getParsedBody();

        // Obtendo dados do dataset
        $this->rider = new Coordinates($request->rider, $request->id);
        $result = $this->rider->getCoordinates();

        return $this->responseJson(true, "Coordenadas encontradas", $result);
    }

    public function bbox(): Response
    {

        // Obtendo dados da requisição
        $request = (object)getRequest()->getParsedBody();

        // Obtendo dados do dataset
        $this->rider = new Coordinates($request->rider, $request->id);
        $result = $this->rider->getBbox();

        return $this->responseJson(true, "Bounding Box encontrado", $result);
    }

    public function centroid(): Response
    {

        // Obtendo dados da requisição
        $request = (object)getRequest()->getParsedBody();

        // Obtendo dados do dataset
        $this->rider = new Coordinates($request->rider, $request->id);
        $result = $this->rider->getCentroid();

        return $this->responseJson(true, "Centroid encontrado", $result);
    }

    public function pointInitial(): Response
    {

        // Obtendo dados da requisição
        $request = (object)getRequest()->getParsedBody();

        // Obtendo dados do dataset
        $this->rider = new Coordinates($request->rider, $request->id);
        $result = $this->rider->getPointInitial();

        return $this->responseJson(true, "Coordenada Inicial encontrada", $result);
    }

    public function maxDistance(): Response
    {

        // Obtendo dados da requisição
        $request = (object)getRequest()->getParsedBody();

        // Obtendo dados do dataset
        $this->rider = new Distance($request->rider);
        $result = $this->rider->maxDistance();

        return $this->responseJson(true, "Distância máxima do $request->rider encontrada", $result);
    }


    public function searchRiders(): Response
    {
        // Obtendo dados da requisição
        $request = (object)getRequest()->getParsedBody();

        // Obtendo dados do dataset
        $this->rider = new Distance($request->rider);
        $result = $this->rider->distances();

        return $this->responseJson(true, "Distâncias do $request->rider encontradas", $result);
    }
}
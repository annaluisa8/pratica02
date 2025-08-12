<?php
require_once __DIR__ . '/vendor/autoload.php';

use Controller\PizzasController;
$pizzasController = new PizzasController();

$method = $_SERVER['REQUEST_METHOD'];

switch ($method) {
    case 'GET':
        $pizzasController->getPizzas();
        break;
    case 'POST':
        $pizzasController->createPizza();
        break;
    case 'PUT':
        $pizzasController->updatePizza();
        break;
    case 'DELETE':
        $pizzasController->deletePizza();
        break;
    default:
        echo json_encode(["message" => "Method not allowed"]);
        break;
}
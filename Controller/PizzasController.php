<?php 

namespace Controller;

use Model\Pizzas;

class PizzasController{
    //Pegar informações
    public function getPizzas()
    {
        $pizza = new Pizzas();
        $pizzas = $pizza->getPizzas();

        if ($pizzas) {
            // Envia a resposta JSON
            header('Content-Type: application/json', true,200);
            echo json_encode($pizzas);
        } else {
            header('Content-Type: application/json', true,404);
            echo json_encode(["message" => "No pizzas found"]);
        }
    }

    //Criar pizza
    public function createPizza()
    {
        $data = json_decode(file_get_contents("php://input"));

        if (isset($data->sabor) && isset($data->tamanho)) {
            $pizza = new Pizzas();
            $pizza->sabor = $data->sabor;
            $pizza->tamanho = $data->tamanho;

            if ($pizza->createPizza()) {
                header('Content-Type: application/json', true,201);
                echo json_encode(["message" => "pizza created successfully"]);
            } else {
                header('Content-Type: application/json', true,500);
                echo json_encode(["message" => "Failed to create pizza"]);
            }
        } else {
            header('Content-Type: application/json', true,400);
            echo json_encode(["message" => "Invalid input"]);
        }
    }

    //Atualizar dados
    public function updatePizza(){

        $data = json_decode(file_get_contents("php://input"));

        if (isset($data->id) && isset($data->sabor) && isset($data->tamanho)) {
            $pizza = new Pizzas();
            $pizza->id = $data->id;
            $pizza->sabor = $data->sabor;
            $pizza->tamanho = $data->tamanho;

            if ($pizza->updatepizza()) {
                header('Content-Type: application/json', true,200);
                  echo json_encode(["message" => "pizza updated successfully"]);
            } else {
                header('Content-Type: application/json', true,500);
                echo json_encode(["message" => "Failed to update pizza"]);
            }
        } else {
            header('Content-Type: application/json', true,400);
            echo json_encode(["message" => "Invalid input"]);
        }
    }

    //Apagar cadastro
    public function deletePizza(){
         $id = $_GET['id'] ?? null; 

        if ($id) {
            $pizza = new Pizzas();
            $pizza->id = $id;

            if ($pizza->deletePizza()) {
                header('Content-Type: application/json', true,200);
                  echo json_encode(["message" => "User deleted successfully"]);
            } else {
                header('Content-Type: application/json', true,500);
                echo json_encode(["message" => "Failed to delete user"]);
            }
        } else {
            header('Content-Type: application/json', true,400);
            echo json_encode(["message" => "Invalid ID"]);
        }
    }
}

?>
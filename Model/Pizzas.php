<?php 

namespace Model;

use PDO;
use Model\Connection;

class Pizzas {
    private $conn;

    public $id;
    public $sabor;
    public $tamanho; 

        public function __construct()
    {
        $this->conn = Connection::getConnection();
    }

    //Obter todas as pizzas cadastradas
        public function getPizzas()
    {
        $sql = "SELECT * FROM pizzas";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Criare nova pizza
    public function createPizza()
    {
        $sql = "INSERT INTO pizzas (sabor, tamanho) VALUES (:sabor, :tamanho)";
        $stmt = $this->conn->prepare($sql);

        $stmt->bindParam(":sabor", $this->sabor, PDO::PARAM_STR);
        $stmt->bindParam(":tamanho", $this->tamanho, PDO::PARAM_STR);

        if ($stmt->execute()) {
            return true;
        }

        return false;
    }

     //Atualizar informações

    public function updatePizza(){
        $sql = "UPDATE pizzas SET sabor = :sabor, tamanho = :tamanho WHERE id = :id";
        $stmt = $this->conn->prepare($sql);

        $stmt->bindParam("id", $this->id, PDO::PARAM_INT);
        $stmt->bindParam("sabor", $this->sabor, PDO::PARAM_STR);
        $stmt->bindParam("tamanho", $this->tamanho, PDO::PARAM_STR);

        if ($stmt->execute()) {
            return true;
        }
        return false;
    }

    //Apagar pizza

    public function deletePizza(){
        $sql = "DELETE FROM pizzas WHERE id = :id";
        $stmt = $this->conn->prepare($sql);

        $stmt->bindParam("id", $this->id, PDO::PARAM_INT);

        if ($stmt->execute()) {
            return true;
        }

        return false;
    }

}

?>
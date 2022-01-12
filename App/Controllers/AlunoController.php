<?php

namespace App\Controllers;

use App\Factories\DatabaseFactory as DB;

class AlunoController
{
    protected $database;

    function __construct()
    {
        $this->database = DB::instance()->getConnection();
    }

    public function index() 
    {
       $stmt = $this->database->query("select * from alunos");
       $resultado = json_encode($stmt->fetchAll(\PDO::FETCH_ASSOC));

       echo $resultado;
       
    }

    public function pesquisarPorId()
    {
        try {
            $stmt = $this->database->prepare("select * from alunos where aluno_id=:id");
            
            $stmt->bindValue(":id", $_GET['id']);

            $stmt->execute();

            $count = $stmt->rowCount();
            
            if($count == 0) {
                echo json_encode(['resultado' => 'não encontrado']);
                
            } else {
                $resultado = json_encode($stmt->fetchAll(\PDO::FETCH_ASSOC));

                echo $resultado;
            }


        } catch (PDOException $error) {
            if($error) {
                echo json_encode(["erro" => "erro generico"]);
            }
        }
        
    }

    public function cadastrarAluno()
    {
        $input = json_decode(file_get_contents('php://input'), true);
     
        if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
            header("HTTP/1.1 200 OK");
            return;
        
        }

        try {
            $data = $input['data'];

            $stmt = $this->database->prepare("insert into alunos (nome, cpf, rg, email, celular, telefone, endereco ) values (:nome, :cpf, :rg, :email, :celular, :telefone, :endereco)");
        
            $stmt->bindValue(":nome", $data['nome']);
            $stmt->bindValue(":cpf", $data['cpf']);
            $stmt->bindValue(":rg", $data['rg']);
            $stmt->bindValue(":email", $data['email']);
            $stmt->bindValue(":celular", $data['celular']);
            $stmt->bindValue(":telefone", $data['telefone']);
            $stmt->bindValue(":endereco", $data['endereco']);
            
            $stmt->execute();
            echo json_encode(['mensagem' => "Cadastrado efetuado com sucesso com suscesso!"]);

        } catch (\PDOException $error) {
            if($error->getCode() == 23000) {
                echo json_encode(['mensagem' => "O CPF ou RG já estão em uso."]);
            } else {
                echo json_encode(["mensagem" => "erro interno"]);
            }            
        }
    }

    public function alterarDadosPessoais()
    {
        $input = json_decode(file_get_contents("php://input", true));

        if($_SERVER["REQUEST_METHOD"] === 'OPTIONS') {
            header('HTTP/1.1 200 ok');
            return;
        }
        
        $data = $input['data'];
        $aluno_CPF = $data['cpf'];

        try {
            $stmt = $this->database->prepare("update alunos set email=:email, celular=:celular, telefone=:telefone, endereco=:endereco where cpf=:cpf");

            $stmt->bindValue(":cpf", $aluno_CPF);
            $stmt->bindValue(":celular", $data['cpf']);
            $stmt->bindValue(":telefone", $data['telefone']);

            $stmt->execute();

        } catch(\PDOexception $error) {

        }
    }
}
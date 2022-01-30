<?php

namespace App\Controllers;

use \App\Services\Database;
use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;


class AlunoController
{
    private $database;

    public function __construct()
    {
        $this->database = Database::instance()->getConnection();
    }

    public function index($request, $response) 
    {
        $query = $this->database->query("select * from alunos");

        $query->execute();

        $result = json_encode($query->fetchAll(\PDO::FETCH_ASSOC));

        $response->getBody()->write($result);

        return $response;//->withHeader("Content-type", "Application/json");
    }

    public function pesquisarPorId($request, $response, $args)
    {
        try {
            $aluno_id = $args['aluno_id'];

            $stmt = $this->database->prepare("select * from alunos where aluno_id=:id");
            
            $stmt->bindValue(":id", $aluno_id);

            $stmt->execute();

            $count = $stmt->rowCount();
            
            if($count == 0) {
                $resultado = json_encode([
                    "resultado" => "não encontrado"
                ]);

                $response->getBody()->write($resultado);
                return $response->withHeader("Content-type", "Application/json");
                
            } else {
                $resultado = json_encode($stmt->fetchAll(\PDO::FETCH_ASSOC));
                $response->getBody()->write($resultado);

                return $response->withHeader("Content-type", "Application/json");;
            }


        } catch (\PDOException $error) {
            if($error) {
                $response->getBody(json_encode(["error" => "genericoo"]))->withHeader("Content-type", "Application/json");;
            }
        }
        
    }

    public function cadastrarAluno($request, $response)
    {   
        $input = json_decode(file_get_contents('php://input'), true);

        try {
            $stmt = $this->database->prepare("insert into alunos (nome, cpf, rg, email, celular, telefone, endereco ) values (:nome, :cpf, :rg, :email, :celular, :telefone, :endereco)");
        
            $stmt->bindValue(":nome", $input['nome']);
            $stmt->bindValue(":cpf", $input['cpf']);
            $stmt->bindValue(":rg", $input['rg']);
            $stmt->bindValue(":email", $input['email']);
            $stmt->bindValue(":celular", $input['celular']);
            $stmt->bindValue(":telefone", $input['telefone']);
            $stmt->bindValue(":endereco", $input['endereco']);
            
            $stmt->execute();

            $successMessage = json_encode(['mensagem' => "Cadastro efetuado com sucesso com sucesso!"]);

            $response->getBody()->write($successMessage);
            return $response;

        } catch (\PDOException $error) {
            if($error->getCode() == 23505) {
                $duplicateErrorMessage = json_encode(['mensagem' => "O CPF ou RG já estão em uso."]);
                //response for duplicate entries
                $response->getBody()->write($duplicateErrorMessage);
                return $response;

            } else {
                //Goes to the log soon
            }            
        }
    }

    public function alterarDadosPessoais($request, $response)
    {
        $input = json_decode(file_get_contents("php://input", true));

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
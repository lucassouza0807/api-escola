<?php 
namespace App\Models;

use PDO ;

class Model 
{
    protected $database ;
    private $logger ;

    public function __construct()
    {
        try{
            $db =  new PDO("pgsql:host=ec2-52-72-125-94.compute-1.amazonaws.com; port=5432; dbname=dd0vqrniqseo2f", "rpeuxfjbwbntcm", "8dc4dcd462c971961ba9c076c0e1368d6a6de3932d671107b4e4f2a00ab47915");
            $db->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
            $this->database = $db ;

            $sql = "CREATE TABLE `alunos` (
                `aluno_id` int(11) NOT NULL AUTO_INCREMENT,
                `nome` varchar(100) DEFAULT NULL,
                `sobrenome` varchar(100) DEFAULT NULL,
                `RA` varchar(45) DEFAULT NULL,
                `RG` varchar(45) DEFAULT NULL,
                `CPF` varchar(45) DEFAULT NULL,
                `telefone` varchar(45) DEFAULT NULL,
                `celular` varchar(45) DEFAULT NULL,
                `endereco` varchar(200) DEFAULT NULL,
                `email` varchar(200) DEFAULT NULL,
                PRIMARY KEY (`aluno_id`),
                UNIQUE KEY `RA` (`RA`),
                UNIQUE KEY `RG` (`RG`),
                UNIQUE KEY `CPF` (`CPF`)
              ) ENGINE=InnoDB AUTO_INCREMENT=93 DEFAULT CHARSET=utf8mb4;
              ";

           $db->query($sql);

           $db->execute();

        }catch(\PDOException $e){
            

        }
        
    }
    function createDatabase()
    {
        

          

          
    }
    function create(array $input = [])
    {
        $fieldsOfTheTable = [];
        $table = $this->table ;
        
        foreach($input as $fieldName => $value){
           array_push($fieldsOfTheTable, $fieldName);
        }

        $implodedField = implode(", ", $fieldsOfTheTable);
        $placeholderColumns = implode(", :", $fieldsOfTheTable); 

        try{

            $sql = "insert into {$table} ($implodedField) values (:$placeholderColumns)";
            $stmt = $this->database->prepare($sql);

            foreach($input as $row => $value){
                $stmt->bindValue(":$row", $value);
            }

            $stmt->execute();

        }catch(\PDOException $e){

            if($code = 23000){
                header("HTTP/1.0 404 Not Found");
            }
        }   
    }

    public function all()
    {
        $result = [];

        try{

            $sql = "select * from {$this->table}" ;
            $stmt = $this->database->query($sql);
            $stmt->execute();

            while($row = $stmt->fetchAll(PDO::FETCH_ASSOC)){
                $result = $row ;
            }

        }catch(\PDOException $e){
            echo "ERROR :".$e->getMessage();

        }

        return $result ;
    }

    public function find($id)
    {
        $result= [];

        try{
            $sql = "select * from {$this->table} where {$this->primaryKey} = :id" ;
            $stmt = $this->database->prepare($sql);
            $stmt->bindParam(":id", $id);
            $stmt->execute();
            $result = $stmt->fetch(PDO::FETCH_ASSOC);

        }catch(Exception $e){
            return "ERROR";
        }
        
        return $result ;

    }
}

$obj = new Model ;

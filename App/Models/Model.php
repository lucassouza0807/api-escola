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
            $db =  new PDO("pgsql:host=ec2-52-21-252-142.compute-1.amazonaws.com; port=5432; dbname=ddfo99qtip1oao", "hybvpbfqoyveog", "a0bb04bbf16af7ce4665e64cb4f7a90167bf20733214e248f5609ba7de84ef79");

            $db->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
            $this->database = $db ;

        }catch(\PDOException $e){
            

        }
        
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

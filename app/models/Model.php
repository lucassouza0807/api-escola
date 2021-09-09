<?php 
namespace App\Models;

require __DIR__."/../../vendor/autoload.php" ;
use PDO ;

class Model 
{
    protected $database ;
    private $logger ;

    public function __construct()
    {
        try{
            $db =  new PDO("mysql:host=localhost; dbname=escola_sao_camilo", "root", "");
            $db->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
            $this->database = $db ;
            

        }catch(\PDOException $e){
            

        }
        
    }

    public function create(array $input = [])
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

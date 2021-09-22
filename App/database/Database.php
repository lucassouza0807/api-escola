<?php 

namespace App\Database ;

use PDO ;

class Database 
{
    private $connection ;
    
    public function __construct()
    {
        try{

            require_once __DIR__."/config.php" ;
            
            $db = [
                "driver" => DRIVER,
                "host" => HOST,
                "db_name" => DB_NAME,
                "user" => DB_USER,
                "password" => DB_PASSWORD  
            ];

            $conn =  new PDO("{$db['driver']}:host={$db['host']}; dbname={$db['db_name']}", "{$db['user']}", "{$db['password']}");
            $conn->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);

           $this->connection = $conn ;
            
        }catch(\PDOException $e){
            echo $e->getMessage();
        }    
    }

    public function getDatabase()
    {
        return $this->connection ;
    }

}
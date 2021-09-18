<?php 

namespace App\Database ;

require_once __DIR__."/../../vendor/autoload.php" ;

use PDO ;

class DB 
{
    protected $database ;

    public function getDatabase()
    {
        try{

            require_once __DIR__."/config.php" ;
            
            $db =  new PDO("`{DRIVER}:host={HOST}; dbname={DB_HOST}", "DB_USER", "{DB_PASSWORD}");
            $db->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);

            return $db ;
            
        }catch(\PDOException $e){
            

        }    
    }

}
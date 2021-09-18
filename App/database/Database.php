<?php 

namespace App\Database ;

class DB 
{
    protected $database ;

    public function getDatabase()
    {
        try{

            include_once __DIR__."/../../database/database.conf.php" ;
            
            $db =  new PDO("`{DRIVER}:host={HOST}; dbname={DB_HOST}", "DB_USER", "{DB_PASSWORD}");
            $db->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);

            return $db ;
            
        }catch(\PDOException $e){
            

        }    
    }

}
<?php 

namespace App\Database ;

use PDO;

class Database 
{
    private static $instance ;

    protected function __construct()
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

            $conn = new PDO(
                "{$db['driver']}:host={$db['host']}; dbname={$db['db_name']}; port=5432", "{$db['user']}", "{$db['password']}",
                [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]
            );

            $conn->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);

            $this->connection = $conn ;

            
        }catch(\PDOException $e){
            $message = $e->getMessage();

            $api_key = "5299792817:AAHhazae3qPZdAQbFulwtO-a7wjsriyZQsY";

            $data = [
                "chat_id" => "5292413053",
                "text" => $message
            ];

            $sendMessage = file_get_contents("https://api.telegram.org/bot$api_key/sendMessage?" . http_build_query($data) );
            

        }
        
        
    }
    
    protected function __clone() {}

    public function __wakeup() {
        throw new \Exception("Cannot unserialize a singleton.");
    }

    public static function instance() : Database
    {
        $class = static::class;

        if (!isset(self::$instance[$class])) {
            self::$instance[$class] = new static();

        }

        return self::$instance[$class];

    }

    
    public function getConnection()
    {
        return $this->connection ;
    }

}




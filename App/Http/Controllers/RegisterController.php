<?php 

namespace App\Http\Controllers ;

use App\Http\Request ;
use App\Factories\DatabaseFactory as DB;
use League\Plates\Engine ;

class RegisterController
{

    public function registerNewUser()
    {
        try{
            $request = new Request();
            $db = DB::instance()->getDatabase(); //Instâcia do bando de dados.

            $hashed_password = password_hash($request->input("senha"), PASSWORD_BCRYPT);

            $stmt = $db->prepare("insert into usuarios (nome, email, senha) values (:nome, :email, :senha)");
            
            $stmt->bindValue(":nome", $request->input("nome"));
            $stmt->bindValue(":email", $request->input("email"));
            $stmt->bindValue(":senha", $hashed_password);

            echo $request->input("nome");

            $stmt->execute();

        }catch(\PDOException $e){
           $error_code = $e->getCode();

           switch($error_code){
               case $error_code == 23000:
                echo "O email inserido já existe";
                break ;
               default:
                echo "Erro interno";
           }
        }    
        
        
    }

    public function render()
    {
        //return $this->templates->render('home');
    }

}
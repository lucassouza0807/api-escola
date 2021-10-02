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

            $user_data = $request->get(); //Esses dados já vem sanitizados e livres de qualquer ação maliciosa.
            $hashed_password = password_hash($user_data['senha'], PASSWORD_BCRYPT);

            $stmt = $db->prepare("insert into usuarios (nome, email, senha) values (:nome, :email, :senha)");

            $stmt->bindParam(":nome", $user_data['nome']);
            $stmt->bindParam(":email", $user_data['email']);
            $stmt->bindParam(":senha", $hashed_password);

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
<?php

namespace App\Controllers;

use App\Factories\DatabaseFactory as DB;

class MatriculaController
{
    private $database;

    function __construct()
    {
        $this->database = DB::instance()->getConnection();
    }
    
    public function verificarMatricula($aluno_ID)
    {
        $maxExpirateTime = 5;

        if($aluno_ID == 5){
            echo "teste";
        } else {
            echo "Pessoa";
        }
    }
}

<?php 

namespace App\Controllers ;

require __DIR__."/../../vendor/autoload.php" ;

use App\Models\Aluno ;

class RegisterController
{
    private $aluno ;

    function __construct()
    {
        $this->aluno = new Aluno ;
    }

    public function register()
    {
        $this->aluno->create([
            "nome" => $_POST['nome'],
            "sobrenome" => $_POST['sobrenome'],
            "email" => $_POST['email'],
            "RA" => $_POST['RA'],
            "RG" => $_POST['RG'],
            "CPF" => $_POST['CPF'],
            "telefone" => $_POST['telefone'],
            "celular" => $_POST['celular'],
            "endereco" => $_POST['endereco']
        ]);
    }
}
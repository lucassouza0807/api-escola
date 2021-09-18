<?php 

namespace App\Http\Controllers ;

use App\Models\Aluno ;

class RegisterController
{
    private $aluno ;
    
    /*public function __construct(Aluno $aluno)
    {
        $this->aluno = $aluno ;
    }*/

    public function register(Aluno $aluno)
    {
        Aluno::create([
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
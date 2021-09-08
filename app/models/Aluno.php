<?php 
namespace App\Models ;

require __DIR__."/../../vendor/autoload.php" ;

use App\Models\Model;

class Aluno extends Model
{
    protected $table = "alunos" ;
    protected $primaryKey = "aluno_id" ;

}
<?php 

require_once __DIR__."/../vendor/autoload.php" ;

use PHPUnit\Framework\TestCase ;
use App\Http\Controllers\RegisterController ;

/** @test */

class MatriculaControllerTest extends TestCase
{
    /** @test **/
    public function testIfControllerWorks()
    {
        $controller = new RegisterController ;

        $this->assertTrue($controller->register());
    }
}
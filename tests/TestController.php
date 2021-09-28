<?php 

require_once __DIR__."/../vendor/autoload.php" ;

use PHPUnit\Framework\TestCase ;
use App\Http\Controllers\RegisterController ;

/** @test */

class TestController extends TestCase
{
    /** @test **/
    public function TestIfControllerWorks()
    {
        $controller = new RegisterController ;

        $this->assertTrue($controller->register());
    }
}
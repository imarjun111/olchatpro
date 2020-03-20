<?php
namespace App\Test\TestCase\Controller;

use App\Controller\Admin\AdminsController;
use Cake\TestSuite\IntegrationTestTrait;
use Cake\TestSuite\TestCase;

/**
 * App\Controller\Admin/AdminsController Test Case
 *
 * @uses \App\Controller\Admin/AdminsController
 */
class AdminsControllerTest extends TestCase
{
    use IntegrationTestTrait;

    /**
     * Test initial setup
     *
     * @return void
     */
    public function setUp(){

    }
    // public function testInitialization()
    // {
    //     $this->markTestIncomplete('Not implemented yet.');
    // }

    public function testBar(){
        $result = 4*3;
        $this->assertEquals(12,$result);
    }
    public function testBar2(){
        $result = 4*4;
        $this->assertEquals(16,$result);
    }

    public function tearDown()
    {
        
    }


}

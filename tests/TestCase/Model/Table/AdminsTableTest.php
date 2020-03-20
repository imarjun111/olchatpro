<?php


namespace App\Test\TestCase\Model\Table;
 
use App\Model\Table\ArticlesTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;
 
class ArticlesTableTest extends TestCase
{
  //public $fixtures = ['app.Admins'];
 
    public function setUp()
    {
        parent::setUp();
        $this->Admins = TableRegistry::getTableLocator()->get('Admins');
    }
 
    public function testFindPublished()
    {
        $query = $this->Admins->find('all')->select(['id','f_name'])->limit(2);
        $this->assertInstanceOf('Cake\ORM\Query', $query);
        $result = $query->enableHydration(false)->toArray();
        //pr($result);die;
        $expected = [
            ['id' => 1, 'f_name' => 'test'],
            ['id' => 2, 'f_name' => 'demo']
        ];
 
        $this->assertEquals($expected, $result);
    }
}
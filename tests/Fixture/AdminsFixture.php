<?php
namespace App\Test\Fixture;
 
use Cake\TestSuite\Fixture\TestFixture;
 
class AdminsFixture extends TestFixture
{
      // Optional. Set this property to load fixtures to a different test datasource
      public $connection = 'test';
 
      public $fields = [
          'id' => ['type' => 'integer'],
          'f_name' => ['type' => 'string', 'length' => 255, 'null' => false],
          'l_name' => ['type' => 'string', 'length' => 255, 'null' => false],
          'address' => 'text',
          'phone_number' => ['type' => 'string', 'length' => 255, 'null' => false],
          'email' => ['type' => 'string', 'length' => 255, 'null' => false],
          'username' => ['type' => 'string', 'length' => 255, 'null' => false],
          'password' => ['type' => 'string', 'length' => 255, 'null' => false],
          'token' => 'text',
          'created' => 'datetime',
          'modified' => 'datetime',
          '_constraints' => [
            'primary' => ['type' => 'primary', 'columns' => ['id']]
          ]
      ];
      public $records = [
          [
              'f_name' => 'First Article',
              'l_name' => 'First Article lname',
              'address' => 'First Article Body address',
              'phone_number' => '123568978',
              'email' => 'adminqwqw@gmail.com',
              'username' => 'sdfds',
              'password' => '112345',
              'token' => 'sdfdsfdsfdf4ew5rewsdf4tdfdg5y6h',
              'created' => '2007-03-18 10:39:23',
              'modified' => '2007-03-18 10:41:31'
          ],
          [
                'f_name' => 'First23 Article',
                'l_name' => 'First23 Article lname',
                'address' => 'First23 Article Body address',
                'phone_number' => '1233568978',
                'email' => 'adminq23wqw@gmail.com',
                'username' => 'sdfds23',
                'password' => '112345',
                'token' => 'sdfdsfddsf45sfdf4ew5rewsdf4tdfdg5y6h',
                'created' => '2007-03-18 10:41:23',
                'modified' => '2007-03-18 10:43:31'
          ]
      ];
 }

 
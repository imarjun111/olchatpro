<?php
namespace App\Model\Table;

use App\Model\Entity\Admin;
use Cake\ORM\Table;
use Cake\Validation\Validator;

class AdminsTable extends Table
{
    public function initialize(array $config)
    {
        $this->addBehavior('Timestamp');
        // $this->belongsTo('user', [
        //     'className' => 'Users',
        //     'foreignKey' => 'user_id'
        // ]);

       

    }

}

?>
<?php
namespace App\Model\Table;

use App\Model\Entity\User;
use Cake\ORM\Table;
use Cake\Validation\Validator;

class UsersTable extends Table
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
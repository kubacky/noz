<?php

namespace app\models\forms;

use app\models\User;
use yii\base\Model;

class UserForm extends Model
{
    public $first_name;
    public $last_name;
    public $email;
    public $password;
    public $is_admin;

    private $_user = false;

    public function rules()
    {
        return [
            [[
                'first_name',
                'last_name',
                'email',
                'password',
                'is_admin'
            ], 'required'],
            ['is_admin', 'integer', 'min' => 0, 'max' => 1],
            ['email', 'email'],
            [['first_name', 'last_name'], 'string']
        ];
    }

    public function save($attributes)
    {
        if ($this->validate()) {
            $user = new User();
            $user->setScenario(User::SCENARIO_REGISTER);

            $user->attributes = $attributes;
            $user->save(false);

            return $user->getPrimaryKey();
        }
    }

    private function _getUser()
    {
        $this->_user = User::findByEmail($this->email);
        if (!$this->_user) {
            $this->_user = new User();
        }
        return $this->_user;
    }
}
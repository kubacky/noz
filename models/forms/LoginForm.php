<?php

namespace app\models\forms;

use app\models\User;
use Yii;
use yii\base\Model;

class LoginForm extends Model
{
    public $email;
    public $password;
    public $remember_me;

    private $_user = false;

    public function rules()
    {
        return [
            [['email', 'password'], 'required'],
            ['email', 'email'],
            ['password', 'validatePassword'],
            ['remember_me', 'integer', 'min' => 0, 'max' => 1]
        ];
    }

    public function validatePassword($attribute, $params) {
        if(!$this->hasErrors()) {
            $user = $this->_getUser();

            if(!$user || !$user->validatePassword($this->password)){
                $this->addError($attribute, 'Incorrect username or password.');
            }
        }
    }

    public function login() {
        if($this->validate()) {
            $remember = $this->_shouldRemember();
            return Yii::$app->user->login($this->_user, $remember ? 3600*24*30 : 0);
        }
    }

    private function _getUser() {
        if($this->_user === false) {
            $this->_user = User::findByEmail($this->email);
        }
        return $this->_user;
    }

    private function _shouldRemember()
    {
        $remember = intval($this->remember_me);
        return $remember === User::REMEMBER_USER;
    }
}

<?php

namespace app\models;

use Yii;
use yii\db\ActiveRecord;
use yii\web\IdentityInterface;

class User extends ActiveRecord implements IdentityInterface
{
    const USER_ACTIVE = 1;
    const USER_INACTIVE = 0;

    const ROLE_ADMIN = 1;
    const ROLE_USER = 0;

    const SCENARIO_LOGIN = 'login';
    const SCENARIO_REGISTER = 'register';

    const REMEMBER_USER = 1;

    public function scenarios()
    {
        return [
            self::SCENARIO_LOGIN => [
                'email',
                'password',
                'remember_me'
            ],
            self::SCENARIO_REGISTER => [
                'email',
                'password',
                'first_name',
                'last_name',
                'is_admin'
            ]
        ];
    }

    public function rules()
    {
        $scenarios = $this->scenarios();
        return [
            [$scenarios[self::SCENARIO_REGISTER], 'required', 'on' => self::SCENARIO_REGISTER],
            [$scenarios[self::SCENARIO_LOGIN], 'required', 'on' => self::SCENARIO_LOGIN],
            [['first_name', 'last_name'], 'string', 'max' => 45],
            ['email', 'email'],
            ['is_admin', 'integer', 'min' => 0, 'max' => 1]
        ];
    }

    public static function findAll($status = self::USER_ACTIVE)
    {
        return parent::findAll(['flag', $status]);
    }

    public static function findIdentity($id)
    {
        return parent::findOne(['id' => $id, 'flag' => self::USER_ACTIVE]);
    }

    public static function findIdentityByAccessToken($token, $type = null)
    {
        return parent::findOne(['access_token' => $token, 'flag' => self::USER_ACTIVE]);
    }

    public static function findByEmail($email)
    {
        return parent::findOne(['email' => $email, 'flag' => self::USER_ACTIVE]);
    }

    public function validateAuthKey($authKey)
    {
        return $this->getAuthKey() === $authKey;
    }

    public function getId()
    {
        return $this->id;
    }

    public function getAuthKey()
    {
        return $this->access_token;
    }

    public static function isAdmin()
    {
        if(!Yii::$app->user->isGuest) {
            return Yii::$app->user->getIdentity()->is_admin == self::ROLE_ADMIN;
        }
        return false;
    }

    public function beforeSave($insert)
    {
        if (parent::beforeSave($insert)) {
            if ($this->isNewRecord) {
                $this->password = $this->_getPasswordHash($this->password);
                $this->access_token = $this->_getRandomString();
            }
            return true;
        }
        return false;
    }

    public function validatePassword($password)
    {
        return Yii::$app->getSecurity()->validatePassword($password, $this->password);
    }

    private function _getRandomString()
    {
        return Yii::$app->security->generateRandomString();
    }

    private function _getPasswordHash($password)
    {
        return Yii::$app->getSecurity()->generatePasswordHash($password);
    }
}
<?php


namespace app\models;

use Yii;
use yii\db\ActiveRecord;

class AppModel extends ActiveRecord
{
    public function beforeSave($insert)
    {
        if (parent::beforeSave($insert)) {
            if ($this->isNewRecord) {
                $this->_addUserId();
            }
            return true;
        }
        return false;
    }

    private function _addUserId() {
        if(!Yii::$app->user->isGuest) {
            $this->user_id = Yii::$app->user->getId();
        }
    }
}
<?php
namespace app\models;

use yii\db\ActiveRecord;

class Setting extends ActiveRecord
{

    public static function findAll($parsed = false) {
        $settings = parent::find()
            ->asArray()
            ->all();

        return $parsed ? self::_parse($settings) : $settings;
    }

    public static function findByName($name)
    {
        return parent::findOne(['name' => $name]);
    }

    private static function _parse($settings) {
        $return = [];
        foreach ($settings as $setting) {
            $return[$setting['name']] = $setting['value'];
        }
        return $return;
    }
}
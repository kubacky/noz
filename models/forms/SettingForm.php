<?php

namespace app\models\forms;

use app\models\Setting;
use yii\base\Model;

class SettingForm extends Model
{
    public $slide_time;
    public $image_width;
    public $image_height;
    public $launch_day;
    public $duration_time;
    public $require_approval;

    private $_setting;
    private $_humans = [
        'image_width' => 'Offer image width',
        'image_height' => 'Image height',
        'launch_day' => 'Day of the week on which the offers start',
        'duration_time' => 'Single slide display time in seconds',
        'require_approval' => 'Should new offers be accepted by admin?'
    ];

    public function rules()
    {
        return [
            [[
                'slide_time',
                'image_width',
                'image_height',
                'launch_day',
                'duration_time',
                'require_approval'
            ], 'required'],
            ['slide_time', 'integer', 'min' => 1],
            ['image_width', 'integer', 'min' => 100],
            ['image_height', 'integer', 'min' => 100],
            ['launch_day', 'integer', 'min' => 0, 'max' => 6],
            ['duration_time', 'integer', 'min' => 1],
            ['require_approval', 'integer', 'min' => 0, 'max' => 1]
        ];
    }

    public function save() {
        if($this->validate()) {
            return $this->_saveSettings();
        }
        return false;
    }

    private function _saveSettings() {
        $return = true;
        foreach ($this->_humans as $fieldName => $humanName) {
            $setting = $this->_getSetting($fieldName);
            $setting->name = $fieldName;
            $setting->human_name = $humanName;
            $setting->value = $this->$fieldName;

            if(!$setting->save()) {
                $return = false;
                break;
            }
        }
        return $return;
    }

    private function _getSetting($fieldName) {
        $this->_setting = Setting::findByName($fieldName);
        if(!$this->_setting) {
            $this->_setting = new Setting();
        }
        return $this->_setting;

    }
}
<?php

namespace app\widgets;

use app\models\Setting;
use yii\base\Widget;

class ConfigWidget extends Widget
{
    private $_config;

    public function init()
    {
        $this->_config = Setting::findAll(true);
        parent::init();
    }

    public function run()
    {
        return $this->render('config', [
            'config' => $this->_config
        ]);
    }
}
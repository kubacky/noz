<?php

namespace app\controllers;

use Yii;
use app\models\Setting;
use app\models\User;
use yii\web\Controller;

class AppController extends Controller
{
    protected $_config;

    public function init()
    {
        parent::init();
        $this->_config = Setting::findAll(true);

        if(empty($this->_config)) {
            Yii::$app->user->logout();
            return $this->redirect('/launch');
        }
        else {
            $this->_redirectGuest();
        }
    }

    public function actionError()
    {
        return self::render('error');
    }

    public function actionLogout() {
        Yii::$app->user->logout();
        return $this->goHome();
    }

    protected function requiresAdmin()
    {
        if (!User::isAdmin()) {
            return $this->goHome();
        }
    }

    private function _redirectGuest() {
        if (Yii::$app->user->isGuest) {
            return $this->redirect('/login');
        }
    }
}
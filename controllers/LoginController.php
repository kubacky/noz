<?php
namespace app\controllers;

use app\models\forms\LoginForm;
use app\models\Setting;
use yii\web\Controller;
use Yii;

class LoginController extends Controller
{
    public $layout = 'login';

    public function actionIndex()
    {
        $config = Setting::findAll();
        if(empty($config)) {
            return $this->redirect('launch');
        }

        if(!Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new LoginForm();

        if($model->load(Yii::$app->request->post()) && $model->validate()) {
            return $this->_login($model);
        }

        return $this->render('index', [
            'model' => $model,
            'bodyClass' => 'login'
        ]);
    }

    private function _login($model) {
        if($model->login()) {
            return $this->goBack();
        }
    }
}
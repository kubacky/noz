<?php

namespace app\controllers;

use app\models\Branch;
use Yii;
use app\models\forms\SettingForm;
use app\models\forms\UserForm;
use app\models\Setting;
use app\models\User;
use yii\web\Controller;

class LaunchController extends Controller
{
    public $layout = 'launch';
    private $_branches = [
        'flt'=>'flensburg',
        'sln'=>'Schleswig',
        'efz'=>'Eckernförde',
        'nft'=>'Niebüll',
        'syr'=>'Sylt',
        'inb'=>'Wyk auf Föhr',
        'hun'=>'Husum',
        'lza'=>'Rendsburg',
        'hoc'=>'Neumünster',
        'nra'=>'Itzehoe',
        'nrg'=>'Glücksstadt',
        'wiz'=>'Wilster',
        'oha'=>'Eutin',
        'stt'=>'Bad Oldesloe',
        'eln'=>'Elmshorn',
        'baz'=>'Barmstedt',
        'pit'=>'Pinneberg',
        'qbt'=>'Quickborn',
        'sft'=>'Schenefeld',
        'wet'=>'Wedel',
        'slb'=>'Lübz',
        'spa'=>'Parchim',
        'sgu'=>'Güstrow',
        'sga'=>'Gadebusch',
        'sha'=>'Hagenow',
        'slu'=>'Ludwigslust',
        'pri'=>'Perlenberg',
        'sst'=>'Sternberg',
        'ssn'=>'Schwerin',
        'nnn'=>'Rostock'
    ];

    public function actionIndex()
    {
        $config = Setting::findAll();

        if (empty($config)) {
            Yii::$app->user->logout();
            return $this->_makeConfig();
        } else {
            $this->goHome();
        }

    }

    private function _makeConfig()
    {
        $setting_model = new SettingForm();
        $user_model = new UserForm();

        $load = $setting_model->load(Yii::$app->request->post())
            && $user_model->load(Yii::$app->request->post());

        if ($load) {
            $this->_saveData($user_model, $setting_model);
        }
        return $this->_buildForm($setting_model, $user_model);
    }

    private function _saveData($user_model, $setting_model) {

        $setting_model->save();

        $user_model->is_admin = User::ROLE_ADMIN;;
        $attributes = Yii::$app->request->post('UserForm');
        $attributes['is_admin'] = 1;

        $user_id = $user_model->save($attributes);

        $this->_createBranches($user_id);

        return $this->refresh();
    }

    private function _buildForm($setting_model, $user_model)
    {
        return $this->render('index', [
            'setting_model' => $setting_model,
            'user_model' => $user_model
        ]);
    }

    private function _createBranches($user_id) {
        foreach ($this->_branches as $code => $name) {
            $branch = new Branch();
            $branch->user_id = $user_id;
            $branch->code = $code;
            $branch->name = $name;

            $branch->save();
        }
    }
}
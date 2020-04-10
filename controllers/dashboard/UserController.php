<?php

namespace app\controllers\dashboard;


use app\controllers\AppController;
use app\models\forms\UserForm;
use app\models\User;
use Yii;

class UserController extends AppController
{
    public function actionIndex()
    {
        $this->adminRequired();
        $users = User::findAll(User::USER_ACTIVE);

        return $this->render('index', [
            'users' => $users,
            'title' => 'List of active user'
        ]);
    }

    public function actionCreate()
    {
        $this->adminRequired();
        $model = new UserForm();

        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            return $this->_createUser($model);
        }

        return $this->render('create', [
            'model' => $model,
            'title' => 'Create new user'
        ]);
    }

    public function actionEdit($id)
    {
        $this->adminRequired();
        $model = $this->_setModelAttributes($id);

        return $this->render('create', [
            'model' => $model,
            'title' => 'Edit user ' . $model->email
        ]);
    }

    public function actionProfile() {
        $id = Yii::$app->user->getId();
        $model = $this->_setModelAttributes($id);

        return $this->render('create', [
            'model' => $model,
            'title' => 'Edit your profile'
        ]);
    }

    private function _createUser($model) {

    }

    private function _setModelAttributes($id) {
        $user = User::findOne($id);

        $model = new UserForm();
        $model->email = $user->email;
        $model->first_name = $user->first_name;
        $model->last_name = $user->last_name;
        $model->is_admin = $user->is_admin;

        return $model;
    }
}
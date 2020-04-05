<?php

namespace app\controllers\dashboard;


use app\controllers\AppController;
use app\models\User;

class UserController extends AppController
{
    public function actionIndex()
    {
        $this->requiresAdmin();
        $users = User::findAll(User::USER_ACTIVE);

        return $this->render('index', [
            'users' => $users,
            'title' => 'List of active user'
        ]);
    }

    public function actionCreate()
    {
        $this->requiresAdmin();
    }

    public function actionEdit($id)
    {

    }


}
<?php

namespace app\controllers\dashboard;

use app\controllers\AppController;
use app\models\Branch;
use app\models\forms\BranchForm;
use Yii;

class BranchController extends AppController
{

    public function actionIndex()
    {
        $branches = Branch::findAll();

        return $this->render('index', [
            'branches' => $branches,
            'title' => 'View all active branches'
        ]);
    }

    public function actionCreate()
    {
        $model = new BranchForm();

        if($this->_validate($model)) {
            $this->_saveData($model);
        }

        return $this->render('create', [
            'model' => $model,
            'title' => 'Create new branch'
        ]);
    }

    public function actionEdit($id)
    {
        $branch = Branch::findOne($id);
        $model = new BranchForm();

        $model->code = $branch->code;
        $model->name = $branch->name;

        if($this->_validate($model)) {
            $this->_update($branch, $model);
        }

        return $this->render('create', [
            'model' => $model,
            'title' => 'Edit branch: ' . $branch->name
        ]);
    }

    public function actionDelete($id)
    {
        $this->requiresAdmin();
        if (Branch::deleteOne($id)) {
            return $this->redirect(['/dashboard/branch']);
        }
    }

    private function _validate($model) {
        return $model->load(Yii::$app->request->post()) && $model->validate();
    }

    private function _update($branch, $model) {
        $branch->code = $model->code;
        $branch->name = $model->name;

        $branch->save();
        $this->redirect('/dashboard/branch');
    }

    private function _saveData($model) {
        if ($model->save())
            return $this->redirect('/dashboard/branch');
    }
}
<?php

namespace app\controllers\dashboard;

use app\controllers\AppController;
use app\models\forms\UploadForm;
use yii\web\UploadedFile;
use Yii;

class UploadController extends AppController
{
    public function actionIndex()
    {
        $model = new UploadForm();
        if (Yii::$app->request->isPost && self::_validate()) {

            $model->imageFile = UploadedFile::getInstanceByName('file');
            //todo: size validation of uploaded image!!!!!!!!!!!!!!!
            return $model->upload();
        }
    }

    private static function _validate()
    {
        if (isset($_FILES)) {
            return array_key_exists('file', $_FILES);
        }
        return false;
    }
}
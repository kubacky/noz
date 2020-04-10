<?php

namespace app\controllers\dashboard;

use app\controllers\AppController;
use app\models\forms\UploadForm;
use app\models\Setting;
use yii\web\UploadedFile;
use Yii;

class UploadController extends AppController
{
    public function actionIndex()
    {
        $model = new UploadForm();
        if (Yii::$app->request->isPost && self::_validate()) {

            $model->imageFile = UploadedFile::getInstanceByName('file');
            return $model->upload();
        }
        return $this->_responseError();
    }

    private static function _validate()
    {
        if (isset($_FILES)) {
            $size = getimagesize($_FILES['file']['tmp_name']);
            $config = Setting::findAll(true);

            return $size[0] == $config['image_width']
                && $size[1] == $config['image_height'];
        }
        return false;
    }

    private function _responseError() {
        $response = Yii::$app->response;

        $response->statusCode = 406;
        $response->content = 'Something went wrong. Check if the size and type of the image matches requirements.';

        return $response;
    }
}
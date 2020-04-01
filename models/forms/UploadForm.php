<?php

namespace app\models\forms;

use app\models\File;
use Yii;
use yii\base\Model;
use yii\helpers\FileHelper;
use yii\helpers\Inflector;

class UploadForm extends Model
{
    public $imageFile;
    private $_file;
    private static $_upload_path = __DIR__ . '/../../web/assets/img/upload/';

    public function rules()
    {
        return [
            [['imageFile'],
                'file',
                'extensions' => ['png', 'jpg'],
                'mimeTypes' => ['image/jpeg', 'image/png']]
        ];
    }

    public function upload()
    {
        if ($this->validate()) {
            $filename = Inflector::slug($this->imageFile->baseName)
                . '.' . $this->imageFile->extension;

            $path = $this->_makeDirectory();

            $this->_file['filename'] = $filename;

            return $this->_saveFile($path);
        } else {
            return false;
        }
    }

    private function _makeDirectory()
    {
        $upload_dir = self::_getRandomDirname();
        $path = self::$_upload_path . $upload_dir;

        FileHelper::createDirectory($path);
        $this->_file['dirname'] = $upload_dir;

        return $path;
    }

    private function _saveFile($path)
    {
        $file = new File();
        $file->attributes = $this->_file;

        if ($file->save()) {
            $this->imageFile->saveAs($path . '/' . $this->_file['filename']);

            return $file->getPrimaryKey();
        }
        return false;
    }

    private static function _getRandomDirname()
    {
        $dirname = Yii::$app->getSecurity()->generateRandomString(12);

        if (is_dir(self::$_upload_path . $dirname)) {
            self::_getRandomDirname();
        }
        return $dirname;
    }
}
<?php


namespace app\models;

class File extends AppModel
{
    const FILE_ACTIVE = 1;
    const FILE_INACTIVE = 0;

    public function rules()
    {
        return [
            [[
                'filename',
                'dirname'
            ], 'required'],
            ['filename', 'string', 'max' => 60],
            ['dirname', 'string', 'max' => 45]
        ];
    }

    public static function findOne($id) {
        return parent::findOne(['id' => $id]);
    }
}
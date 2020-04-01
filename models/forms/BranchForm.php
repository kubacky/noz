<?php

namespace app\models\forms;

use app\models\Branch;
use yii\base\Model;

class BranchForm extends Model

{
    public $name;
    public $code;

    public function rules()
    {
        return [
            [[
                'name',
                'code'
            ],
                'required'],
            ['name', 'string', 'max' => 45],
            ['code', 'string', 'length' => 3]
        ];
    }

    public function save() {
        $model = new Branch();
        $model->name = $this->name;
        $model->code = $this->code;

        return $model->save();
    }
}
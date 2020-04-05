<?php


namespace app\models;

use yii\helpers\ArrayHelper;

class Branch extends AppModel
{
    const BRANCH_ACTIVE = 1;
    const BRANCH_INACTIVE = 0;

    public function rules()
    {
        return [
            [[
                'name',
                'code'
            ], 'required'],
            ['name', 'string', 'max' => 45],
            ['code', 'string', 'max' => 3]
        ];
    }

    public static function findAll($status = self::BRANCH_ACTIVE)
    {
        return parent::findAll(['flag' => $status]);
    }

    public static function getMappedArrayOfBranches() {
        return ArrayHelper::map(self::findAll(), 'id', 'name');
    }

    public static function deleteOne($id)
    {
        if ($branch = self::findOne($id)) {
            $branch->flag = self::BRANCH_INACTIVE;

            return $branch->save();
        }
    }
}
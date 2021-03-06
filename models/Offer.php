<?php


namespace app\models;

class Offer extends AppModel
{
    const OFFER_ACTIVE = 1;
    const OFFER_INACTIVE = 0;
    const OFFER_NOT_ACCEPTED = 2;
    const OFFER_REJECTED = 3;

    const REQUIRE_APPROVAL = 1;

    public function rules()
    {
        return [
            [[
                'file_id',
                'title',
                'url',
                'launch_date',
                'end_date'
            ], 'required'],
            ['file_id', 'integer', 'min' => 1],
            [['title', 'url'], 'string', 'max' => 45],
            ['description', 'string', 'max' => 200],
            ['launch_date', 'date', 'format' => 'yyyy-mm-dd']
        ];
    }

    public static function findAll($status = self::OFFER_ACTIVE)
    {
        return parent::findAll(['flag' => $status]);
    }

    public static function findAllActive() {
        return parent::find()
            ->where('flag != ' . self::OFFER_INACTIVE)
            ->all();
    }

    public static function findOne($id)
    {
        return parent::findOne(['id' => $id]);
    }
}
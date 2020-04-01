<?php


namespace app\models\forms;

use app\models\Offer;
use yii\base\Model;

class OfferForm extends Model
{
    public $file_id;
    public $title;
    public $description;
    public $url;
    public $branches = [];
    public $launch_date;

    public function rules()
    {
        return [
            [[
                'file_id',
                'title',
                'url',
                'launch_date',
                'branches'
            ], 'required'],
            ['file_id', 'integer'],
            ['title', 'string', 'max' => 45],
            ['url', 'url'],
            ['description', 'string', 'max' => 200],
            ['launch_date', 'date', 'format' => 'yyyy-mm-dd']
        ];
    }

    public function save() {
        if($this->validate()) {
            $offer = new Offer();

            $offer->file_id = $this->file_id;
            $offer->title = $this->title;
            $offer->url = $this->url;
            $offer->launch_date = $this->launch_date;
            $offer->description = $this->description;

            $offer->save();

            return $offer->getPrimaryKey();
        }
    }
}
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
    public $launch_date;
    public $end_date;
    public $branches = [];

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
            [['launch_date', 'end_date'], 'date', 'format' => 'yyyy-mm-dd']
        ];
    }

    public function save($config)
    {
        if ($this->validate()) {
            $offer = new Offer();

            $offer->file_id = $this->file_id;
            $offer->title = $this->title;
            $offer->url = $this->url;
            $offer->launch_date = $this->launch_date;
            $offer->end_date = $this->_calculateOfferEndDate($config);
            $offer->description = $this->description;

            $offer->save();

            return $offer->getPrimaryKey();
        }
    }

    private function _calculateOfferEndDate($config)
    {
        $days = $config['duration_time'] . ' days';
        return date('Y-m-d',
            strtotime($this->launch_date . ' + ' . $days));
    }
}
<?php


namespace app\models\forms;

use yii\db\ActiveRecord;

class BranchOffer extends ActiveRecord
{
    public static function tableName()
    {
        return 'branch_offer';
    }

    public function rules() {
        return [
            [['branch_id', 'offer_id'], 'required'],
            [['branch_id', 'offer_id'], 'integer']
        ];
    }

    public static function findBranchOffers($branch_id) {
        return self::find(['branch_id', $branch_id]);
    }

    public static function getReducedArrayOfBranches($offer_id) {
        $branches = self::findBranchesOfOffer($offer_id);
        $reduced = [];

        foreach ($branches as $branch) {
            $reduced[] = $branch->branch_id . '';
        }
        return $reduced;
    }

    public static function findBranchesOfOffer($offer_id) {
        return self::find(['offer_id', $offer_id])->all();
    }

    public static function deleteBranchOffers($branch_id) {
        return self::deleteAll(['branch_id', $branch_id]);
    }

    public static function deleteBranchesOfOffer($offer_id) {
        return self::deleteAll(['offer_id', $offer_id]);
    }
}
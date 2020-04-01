<?php

namespace app\controllers\dashboard;

use app\controllers\AppController;
use app\models\Branch;
use app\models\forms\BranchOffer;
use app\models\forms\OfferForm;
use app\models\forms\UploadForm;
use app\models\Offer;
use app\models\User;
use Yii;
use yii\helpers\ArrayHelper;

class OfferController extends AppController
{

    public function actionIndex($status = Offer::OFFER_ACTIVE)
    {
        $offers = Offer::findAll($status);

        return $this->render('index', [
            'offers' => $offers,
            'title' => 'View all offers'
        ]);
    }

    public function actionCreate()
    {
        $model = new OfferForm();
        $upload = new UploadForm();

        $branches = ArrayHelper::map(Branch::findAll(), 'id', 'name');

        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            return $this->_createOffer($model);
        }

        return $this->render('create', [
            'model' => $model,
            'upload' => $upload,
            'branches' => $branches,
            'title' => 'Create new offer'
        ]);
    }

    public function actionEdit($offer_id) {
        $offer = Offer::findOne($offer_id);
        $model = new OfferForm();
        $upload = new UploadForm();

        $model->title = $offer->title;
        $model->url = $offer->url;
        $model->description = $offer->descritpion;
        $model->launch_date = date('Y-m-d', strtotime($offer->launch_date));

        $offer_branches = BranchOffer::findBranchesOfOffer();
        $model->branches = ArrayHelper::map($offer_branches, 'id');
        $branches = Branch::findAll();

        return $this->render('create', [
            'model' => $model,
            'upload' => $upload,
            'branches' => $branches,
            'title' => 'Edit offer: ' . $offer->title
        ]);
    }


    public function actionDelete($id)
    {
        $this->requiresAdmin();

        if (Branch::deleteOne($id)) {
            return $this->goBack();
        }
    }

    private function _createOffer($model) {
        $offer_id = $model->save();

        foreach ($model->branches as $branch_id) {
            $branch_offer = new BranchOffer();

            $branch_offer->offer_id = $offer_id;
            $branch_offer->branch_id = $branch_id;

            $branch_offer->save();
        }

        return $this->redirect(['/dashboard/offer']);
    }

    private function _setOfferStatus($offer)
    {
        if (!User::isAdmin()
            && $this->_config->require_approval == Offer::REQUIRE_APPROVAL) {
            return Offer::OFFER_NOT_ACCEPTED;
        }
        return Offer::OFFER_ACTIVE;
    }
}
<?php

namespace app\controllers\dashboard;

use app\controllers\AppController;
use app\models\Branch;
use app\models\File;
use app\models\forms\BranchOffer;
use app\models\forms\OfferForm;
use app\models\forms\UploadForm;
use app\models\Offer;
use app\models\User;
use Yii;

class OfferController extends AppController
{
    public function actionIndex($status = Offer::OFFER_ACTIVE)
    {
        $offers = Offer::findAllActive();

        if(empty($offers)) {
            Yii::$app->session->setFlash('no_ads', 'It seems that no advertising has been added yet');
            return $this->redirect(['/dashboard/offer/create']);
        }

        return $this->render('index', [
            'offers' => $offers,
            'title' => 'View all offers'
        ]);
    }

    public function actionCreate()
    {
        $model = new OfferForm();
        $upload = new UploadForm();

        $branches = Branch::getMappedArrayOfBranches();

        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            return $this->_createOffer($model);
        }

        $flash_title = Yii::$app->session->getFlash('no_ads');
        $title =  $flash_title ? $flash_title : 'Create new offer';

        return $this->render('create', [
            'model' => $model,
            'upload' => $upload,
            'branches' => $branches,
            'title' => $title
        ]);
    }

    public function actionEdit($id)
    {
        $offer = Offer::findOne($id);
        $model = new OfferForm();
        $upload = new UploadForm();

        $model->title = $offer->title;
        $model->url = $offer->url;
        $model->description = $offer->description;
        $model->branches = BranchOffer::getReducedArrayOfBranches($id);
        $model->launch_date = date('Y-m-d', strtotime($offer->launch_date));

        $image = File::findOne($offer->file_id);
        $branches = Branch::getMappedArrayOfBranches();

        return $this->render('create', [
            'model' => $model,
            'upload' => $upload,
            'branches' => $branches,
            'image' => $image,
            'title' => 'Edit offer: ' . $offer->title
        ]);
    }

    public function actionAccept($id) {
        $offer = Offer::findOne($id);

        $offer->flag = Offer::OFFER_ACTIVE;
        $offer->save();

        return $this->redirect(['/dashboard/offer/index']);
    }

    public function actionDelete($id)
    {
        $this->adminRequired();

        if (Branch::deleteOne($id)) {
            return $this->goBack();
        }
    }

    private function _createOffer($model)
    {
        $offer_id = $model->save($this->_config);

        foreach ($model->branches as $branch_id) {
            $branch_offer = new BranchOffer();

            $branch_offer->offer_id = $offer_id;
            $branch_offer->branch_id = $branch_id;

            $branch_offer->save($this->_config);
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
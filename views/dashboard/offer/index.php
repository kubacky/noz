<?php

/* @var $title string */

/* @var $offers array */

use app\models\Offer;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\model\User;

$this->title = $title;
?>

<h1><?= $title ?></h1>

<table class="uk-table uk-table-responsive uk-table-divider">
    <thead>
    <tr>
        <th>Name</th>
        <th style="width: 200px">Will be finished in..</th>
        <th style="width: 100px;"></th>
    </tr>
    </thead>
    <tbody>
    <?php foreach ($offers as $offer):
        $end_date = date('D M d Y H:i:s O', strtotime($offer->end_date)); ?>
        <tr>
            <td>
                <?= Html::encode($offer->title); ?>
            </td>

            <td>
                <?php if ($offer->end_date > date('Y-m-d')): ?>
                    <div uk-countdown="date: <?= $end_date ?>">
                        <span class="uk-countdown-number uk-countdown-days uk-text-small"></span>
                        <span class="uk-countdown-separator uk-text-small">:</span>
                        <span class="uk-countdown-number uk-countdown-hours uk-text-small"></span>
                        <span class="uk-countdown-separator uk-text-small">:</span>
                        <span class="uk-countdown-number uk-countdown-minutes uk-text-small"></span>
                        <span class="uk-countdown-separator uk-text-small">:</span>
                        <span class="uk-countdown-number uk-countdown-seconds uk-text-small"></span>
                    </div>
                <?php else: ?>
                    <span class="uk-text-small">Offer completed</span>
                <?php endif; ?>
            </td>
            <td class="uk-align-right">
                <?php if ($offer->flag == Offer::OFFER_NOT_ACCEPTED && Yii::$app->user->getIdentity()->is_admin == User::ROLE_ADMIN): ?>
                    <a href="<?= Url::to(['dashboard/offer/accept', 'id' => $offer->id]) ?>"
                       class="uk-icon-link uk-margin-small-right" uk-icon="check"></a>
                <?php endif; ?>
                <a href="<?= Url::to(['dashboard/offer/edit', 'id' => $offer->id]) ?>"
                   class="uk-icon-link uk-margin-small-right" uk-icon="file-edit"></a>
                <a href="<?= Url::to(['dashboard/offer/delete', 'id' => $offer->id]) ?>" class="uk-icon-link"
                   uk-icon="trash"></a>
            </td>
        </tr>
    <?php endforeach ?>
    </tbody>
</table>


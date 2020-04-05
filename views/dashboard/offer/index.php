<?php

/* @var $title string */
/* @var $offers array */

use yii\helpers\Html;

$this->title = $title;
use yii\helpers\Url;
?>

<h1><?= $title ?></h1>

<table class="uk-table uk-table-responsive uk-table-divider">
    <thead>
    <tr>
        <th>Name</th>
        <th style="width: 100px;"></th>
    </tr>
    </thead>
    <tbody>
    <?php foreach ($offers as $offer): ?>
        <tr>
            <td>
                <?= Html::encode($offer->title); ?>
            </td>
            <td class="uk-align-right">
                <a href="<?= Url::to(['dashboard/offer/edit', 'id'=>$offer->id]) ?>" class="uk-icon-link uk-margin-small-right" uk-icon="file-edit"></a>
                <a href="<?= Url::to(['dashboard/offer/delete', 'id'=>$offer->id]) ?>" class="uk-icon-link" uk-icon="trash"></a>
            </td>
        </tr>
    <?php endforeach ?>
    </tbody>
</table>


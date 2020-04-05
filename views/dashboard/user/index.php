<?php
/* @var $title string */
/* @var $users array */

use yii\helpers\Html;
use yii\helpers\Url;

$this->title = $title; ?>

<h1><?= $title ?></h1>

<table class="uk-table uk-table-responsive uk-table-divider">
    <thead>
    <tr>
        <th>Name</th>
        <th>Email</th>
        <th style="width: 100px;"></th>
    </tr>
    </thead>
    <tbody>
    <?php foreach ($users as $user): ?>
        <tr>
            <td>
                <?= Html::encode($user->first_name); ?>
                <?= Html::encode($user->last_name); ?>
            </td>
            <td>
                <?= Html::encode($user->email); ?>
            </td>
            <td class="uk-align-right">
                <a href="<?= Url::to(['dashboard/user/edit', 'id'=>$user->id]) ?>" class="uk-icon-link uk-margin-small-right" uk-icon="file-edit"></a>
                <a href="<?= Url::to(['dashboard/user/delete', 'id'=>$user->id]) ?>" class="uk-icon-link" uk-icon="trash"></a>
            </td>
        </tr>
    <?php endforeach ?>
    </tbody>
</table>


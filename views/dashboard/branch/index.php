<?php
/* @var $title string */
/* @var $branches array */

use yii\helpers\Html;
use yii\helpers\Url;

$this->title = $title;
?>
<h1><?= $title ?></h1>

<table class="uk-table uk-table-responsive uk-table-divider">
    <thead>
    <tr>
        <th>Name</th>
        <th>Code</th>
        <th style="width: 100px;"></th>
    </tr>
    </thead>
    <tbody>
    <?php foreach ($branches as $branch): ?>
    <tr>
        <td>
            <?= Html::encode($branch->name); ?>
        </td>
        <td>
            <?= $branch->code; ?>
        </td>
        <td class="uk-align-right">
            <a href="<?= Url::to(['dashboard/branch/edit', 'id'=>$branch->id]) ?>" class="uk-icon-link uk-margin-small-right" uk-icon="file-edit"></a>
            <a href="<?= Url::to(['dashboard/branch/delete', 'id'=>$branch->id]) ?>" class="uk-icon-link" uk-icon="trash"></a>
        </td>
    </tr>
    <?php endforeach ?>
    </tbody>
</table>

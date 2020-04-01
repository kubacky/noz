<?php

/* @var $this \yii\web\View */

/* @var $content string */

use app\widgets\ConfigWidget;
use yii\helpers\Html;
use app\assets\AppAsset;

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?php $this->registerCsrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body>
<?php $this->beginBody() ?>
<?= ConfigWidget::widget(); ?>
<?= $this->render('main/header'); ?>
<?= $this->render('main/sidebar'); ?>
<section class="noz-content uk-section uk-section-default">
    <div class="uk-container uk-container-small uk-position-relative">
        <?= $content ?>
    </div>
</section>
<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>

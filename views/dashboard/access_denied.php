<?php

/* @var $this yii\web\View */
/* @var $name string */
/* @var $message string */

use yii\helpers\Html;

$this->title = $name;
?>
<div class="site-error">
<?php /*
    <h1><?= Html::encode($this->title) ?></h1>

    <div class="alert alert-danger">
        <?= nl2br(Html::encode($message)) ?>
    </div>
*/ ?>
    <p>
        Upssss, du bist nicht berechtigt, diese Seite anzuzeigen ;(
    </p>
</div>

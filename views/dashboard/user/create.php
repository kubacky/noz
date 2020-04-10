<?php
/* @var $title string */
/* @var $form array */

/* @var $model \app\models\forms\UserForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

$this->title = $title;
$fieldTemplate = "
<div class=\"uk-margin\">
    <label class=\"uk-form-label\">{labelTitle}</label>
    <div class=\"uk-form-controls input-transparent\">
        {input}
    </div>
    <span class=\"uk-text-small uk-text-warning\">{error}</span>
</div>";
?>
    <h1><?= Html::encode($title); ?></h1>
<?php $form = ActiveForm::begin([
    'id' => 'user-form',
    'fieldConfig' => [
        'template' => $fieldTemplate,
    ],
]); ?>
    <hr class="uk-divider-icon">
<?= $this->render('./form', [
    'form' => $form,
    'model' => $model
]); ?>
    <hr class="uk-divider-icon">
<?= Html::submitButton('Let\'s go', [
    'class' => 'uk-button uk-button-primary uk-align-center',
    'name' => 'login-button'
]) ?>

<?php ActiveForm::end(); ?>
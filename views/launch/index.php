<?php

/* @var $this yii\web\View */
/* @var $user_model app\models\forms\UserForm */

/* @var $setting_model app\models\forms\SettingForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

$this->title = 'EAS first run';
$fieldTemplate = "
<div class=\"uk-margin\">
    <label class=\"uk-form-label\">{labelTitle}</label>
    <div class=\"uk-form-controls input-transparent\">
        {input}
    </div>
    <span class=\"uk-text-small uk-text-warning\">{error}</span>
</div>";

?>
<?php $form = ActiveForm::begin([
    'id' => 'login-form',
    'fieldConfig' => [
        'template' => $fieldTemplate,
    ],
]); ?>
<img src="/assets/img/emma_w.svg" class="uk-margin-medium uk-align-center">
<p class="uk-text-light uk-text-center">
    This appears to be your first time running this application.
    Take a moment to set up and create the first user ;)
</p>
<hr class="uk-divider-icon">
<div class="uk-grid-large uk-child-width-expand@m" uk-grid>
    <div>
        <?= $this->render('../dashboard/users/form', [
            'model' => $user_model,
            'form' => $form
        ]); ?>
    </div>
    <div>
        <?= $this->render('../dashboard/settings/form', [
            'model' => $setting_model,
            'form' => $form
        ]); ?>
    </div>
</div>
<hr class="uk-divider-icon">
<?= Html::submitButton('Let\'s go', [
    'class' => 'uk-button uk-button-primary uk-align-center',
    'name' => 'login-button'
]) ?>

<?php ActiveForm::end(); ?>

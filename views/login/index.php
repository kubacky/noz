<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */

/* @var $model app\models\User */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

$this->title = 'Login to EAS';
$fieldTemplate = "
<div class=\"uk-margin\">
    <div class=\"uk-inline uk-width-1-1 input-transparent\">
        <span class=\"uk-form-icon\" uk-icon=\"icon: {labelTitle}\"></span> 
        {input}
    </div>
</div>
<span class=\"uk-text-small uk-text-warning\">{error}</span>
";
?>
<img src="/assets/img/emma_w.svg" class="uk-margin-medium uk-align-center">
<?php $form = ActiveForm::begin([
    'id' => 'login-form',
    'fieldConfig' => [
        'template' => $fieldTemplate,
    ],
]); ?>
<?= $form->field($model, 'email')
    ->textInput([
        'placeholder' => 'your email',
        'autofocus' => true,
        'class' => 'uk-input'
    ])
    ->label('user'); ?>

<?= $form->field($model, 'password')
    ->passwordInput([
        'placeholder' => 'password',
        'class' => 'uk-input'
    ])
    ->label('lock'); ?>

<div class="uk-margin uk-width-1-1">
    <?= $form->field($model, 'remember_me')
        ->checkbox([
            'class' => 'uk-checkbox',
            'template' => "<label>{input} {labelTitle}</label>"
        ]) ?>
</div>


<?= Html::submitButton('Login', [
    'class' => 'uk-button uk-button-primary uk-margin-medium uk-align-center',
    'name' => 'login-button'
]) ?>

<?php ActiveForm::end(); ?>

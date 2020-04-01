<?php

/* @var $model app\models\forms\UserForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

?>
<?= $form->field($model, 'first_name')
    ->textInput([
        'placeholder' => 'Your name',
        'class' => 'uk-input uk-form-small'
    ]) ?>

<?= $form->field($model, 'last_name')
    ->textInput([
        'placeholder' => 'Your surname',
        'class' => 'uk-input uk-form-small'
    ]) ?>
    <hr class="uk-divider-small">
<?= $form->field($model, 'email')
    ->textInput([
        'placeholder' => 'Your email',
        'class' => 'uk-input uk-form-small'
    ]) ?>
<?= $form->field($model, 'password')
    ->passwordInput([
        'placeholder' => 'Password',
        'class' => 'uk-input uk-form-small'
    ]) ?>
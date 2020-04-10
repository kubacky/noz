<?php

/* @var $model app\models\forms\UserForm */
?>

<?= $form->field($model, 'first_name')
    ->textInput([
        'placeholder' => 'Name',
        'class' => 'uk-input uk-form-small'
    ]) ?>

<?= $form->field($model, 'last_name')
    ->textInput([
        'placeholder' => 'Surname',
        'class' => 'uk-input uk-form-small'
    ]) ?>
    <hr class="uk-divider-small">
<?= $form->field($model, 'email')
    ->textInput([
        'placeholder' => 'Email',
        'class' => 'uk-input uk-form-small'
    ]) ?>
<?= $form->field($model, 'password')
    ->passwordInput([
        'placeholder' => 'Password',
        'class' => 'uk-input uk-form-small'
    ]) ?>
<?php

/* @var $model app\models\forms\SettingForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

?>
    <div class="uk-margin">
        <?= $form->field($model, 'launch_day')
            ->dropDownList([
                1 => 'Monday',
                2 => 'Tuesday',
                3 => 'Wednesday',
                4 => 'Thursday',
                5 => 'Friday',
                6 => 'Saturday',
                0 => 'Sunday'
            ], [
                    'class' => 'uk-select uk-form-small',
                    'prompt' => 'Day of the week on which the offers start'
                ]
            ) ?>
    </div>
<?= $form->field($model, 'slide_time')
    ->textInput([
        'placeholder' => 'Time in seconds',
        'class' => 'uk-input uk-form-small'
    ])
    ->label('Single slide display time') ?>

<?= $form->field($model, 'duration_time')
    ->textInput([
        'placeholder' => 'Number of days',
        'class' => 'uk-input uk-form-small'
    ])
    ->label('Offer duration time in days'); ?>
    <hr class="uk-divider-small">
    <div class="uk-margin uk-width-1-1">
        <?= $form->field($model, 'require_approval')
            ->checkbox([
                'class' => 'uk-checkbox',
                'template' => "<label>{input} {labelTitle}</label>"
            ])
            ->label('Should new offers be accepted by admin?') ?>
    </div>
    <hr class="uk-divider-small">
<?= $form->field($model, 'image_width')
    ->textInput([
        'placeholder' => 'Width in pixels',
        'class' => 'uk-input uk-form-small'
    ])
    ->label('Image to the offer: width') ?>

<?= $form->field($model, 'image_height')
    ->textInput([
        'placeholder' => 'Height in pixels',
        'class' => 'uk-input uk-form-small'
    ]) ?>
<?php

/* @var $model app\models\forms\BranchForm */

/* @var $title string */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

$fieldTemplate = "
<div class=\"uk-margin\">
    <label class=\"uk-form-label\">{labelTitle}</label>
    <div class=\"uk-form-controls input-transparent\">
        {input}
    </div>
    <span class=\"uk-text-small uk-text-warning\">{error}</span>
</div>";

$this->title = $title;
?>
<h1><?= $title; ?></h1>
    <?php $form = ActiveForm::begin([
        'id' => 'branch-form',
        'fieldConfig' => [
            'template' => $fieldTemplate,
        ],
    ]); ?>
<hr class="uk-divider-icon">
<div class="uk-grid-medium uk-child-width-expand@m" uk-grid>
    <div class="uk-width-2-3@m">
        <?= $form->field($model, 'name')
            ->textInput([
                'placeholder' => 'Branch name',
                'class' => 'uk-input uk-form-small',
            ])
            ->label('Branch full name');
        ?>
    </div>
    <div class="uk-width-1-3@m">
        <?= $form->field($model, 'code')
            ->textInput([
                'placeholder' => 'Branch code',
                'class' => 'uk-input uk-form-small',
                'options' => [
                    'maxlength' => '3'
                ]
            ])->label('Short name (max. 3 letters)') ?>
    </div>
</div>
<?= Html::submitButton('Save', [
    'class' => 'uk-button uk-button-primary uk-align-center'
]) ?>
<div>

</div>
<?php ActiveForm::end(); ?>

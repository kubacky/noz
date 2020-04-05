<?php
// todo: <edit> make the assignment of branches to the model
/* @var $model app\models\forms\OfferForm */
/* @var $upload app\models\forms\UploadForm */
/* @var $title string */

/* @var $branches array */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

$fieldTemplate = "
<div class=\"uk-margin\">
    <label class=\"uk-form-label\">{labelTitle}</label>
    <div class=\"uk-form-controls input-transparent\">
        {input}
    </div>
    <div class=\"uk-text-small uk-text-warning\" style='clear: both'>{error}</div>
</div>";

$this->title = $title;
?>
<h1><?= $title; ?></h1>
<hr class="uk-divider-icon">
<div class="uk-grid-large uk-child-width-expand@m" uk-grid>
    <div>
        <?php $form = ActiveForm::begin([
            'id' => 'offer-form',
            'fieldConfig' => [
                'template' => $fieldTemplate,
            ]
        ]); ?>
        <?= $form->field($model, 'title')
            ->textInput([
                'placeholder' => 'Offer title',
                'class' => 'uk-input uk-form-small'
            ]) ?>
        <?= $form->field($model, 'url')
            ->textInput([
                'placeholder' => 'Url',
                'class' => 'uk-input uk-form-small'
            ])->label('The url address to which the offer should be redirected') ?>

        <?= $form->field($model, 'launch_date')
            ->textInput([
                'placeholder' => 'Date of beginning',
                'class' => 'uk-input uk-form-small'
            ]) ?>
        <hr class="uk-divider-small">
        <?= $form->field($model, 'description')
            ->textarea([
                'placeholder' => 'Description (optional)',
                'class' => 'uk-input uk-form-small'
            ]) ?>
        <hr class="uk-divider-small">
        <?= $form->field($model, 'file_id')
            ->hiddenInput()
            ->label(false); ?>

        <div class="uk-column-1-2">
            <?= $form->field($model, 'branches')
                ->checkboxList($branches, [
                    'onclick' => "$(this).val( $('input:checkbox:checked').val());",
                    'item' => function ($index, $label, $name, $checked, $value) {
                        return "<label class='uk-align-left'><input class=\"uk-checkbox\" type='checkbox' {$checked} name='{$name}' value='{$value}'> {$label}</label>";
                    }])->label(false) ?>
        </div>
        <div>
            <?= Html::submitButton('Save', [
                'class' => 'uk-button uk-button-primary uk-align-center'
            ]) ?>
        </div>
        <?php ActiveForm::end(); ?>
    </div>

    <div>
        <p class="uk-text-small">Image for the offer</p>
        <?php $form = ActiveForm::begin([
            'id' => 'upload-form',
            'options' => [
                'enctype' => 'multipart/form-data',
                'class' => 'dropzone'
            ]]) ?>
        <?php if (isset($image)): ?>
            <div class="dz-preview dz-file-preview">
                <div class="dz-details">
                    <div class="dz-filename"><span data-dz-name></span></div>
                    <div class="dz-size" data-dz-size></div>
                    <img src="<?= "/assets/img/upload/{$image->dirname}/{$image->filename}"; ?>" data-dz-thumbnail/>
                </div>
                <div class="dz-progress"><span class="dz-upload" data-dz-uploadprogress></span></div>
                <div class="dz-error-mark"><span>✘</span></div>
                <div class="dz-error-message"><span data-dz-errormessage></span></div>
            </div>
        <?php endif; ?>
        <div class="fallback">
            <?= $form->field($upload, 'imageFile')->fileInput() ?>
        </div>
        <?php ActiveForm::end() ?>
    </div>
</div>


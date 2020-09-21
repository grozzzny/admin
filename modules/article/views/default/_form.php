<?php

use dosamigos\tinymce\TinyMce;
use grozzzny\admin\widgets\file_input\ImageInputWidget;
use yii\helpers\Html;
use yii\bootstrap4\ActiveForm;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $model grozzzny\admin\modules\article\models\AdminArticles */
/* @var $form yii\bootstrap4\ActiveForm */
?>

<div class="admin-articles-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'image')->widget(ImageInputWidget::className()) ?>

    <?= $form->field($model, 'slug')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'short')->textarea(['rows' => 4]) ?>

    <?= $form->field($model, 'text')->widget(TinyMce::className(), [
        'options' => ['rows' => 50],
        'language' => 'ru',
        'clientOptions' => [
            'plugins' => [
                "advlist autolink lists link charmap print preview anchor",
                "searchreplace visualblocks code fullscreen",
                "insertdatetime media table contextmenu paste",
                "image code"
            ],
            'toolbar' => "undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image",
            'image_title' => true,
            'automatic_uploads' => true,
            'file_picker_types' => 'image',
            'images_upload_url' => Url::to(['/admin/upload/index']),
        ]
    ]);?>

    <?= $form->field($model, 'active')->checkbox([
        'labelOptions' => ['class' => 'custom-control-label'],
        'options' => ['class' => 'custom-control-input'],
        'template' => "<div class=\"custom-control custom-switch\">{input} {label}</div><div>{error}</div>",
    ]) ?>

    <hr>

    <?= $form->field($model->seo, 'h1') ?>

    <?= $form->field($model->seo, 'title') ?>

    <?= $form->field($model->seo, 'keywords') ?>

    <?= $form->field($model->seo, 'description')->textarea(['rows' => 4]) ?>

    <?= $form->field($model->seo, 'image')->widget(ImageInputWidget::className()) ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

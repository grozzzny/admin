<?php

use grozzzny\admin\widgets\file_input\ImageInputWidget;
use yii\helpers\Html;
use yii\bootstrap4\ActiveForm;
use yii\redactor\widgets\Redactor;

/* @var $this yii\web\View */
/* @var $model grozzzny\admin\modules\pages\models\AdminPages */
/* @var $form yii\bootstrap4\ActiveForm */
?>

<div class="admin-pages-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'image')->widget(ImageInputWidget::className()) ?>

    <?= $form->field($model, 'slug')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'text')->widget(Redactor::className(), [
        'clientOptions' => [
            'minHeight' => '400px',
            'imageManagerJson' => ['/redactor/upload/image-json'],
            'imageUpload' => ['/redactor/upload/image'],
            'fileUpload' => ['/redactor/upload/file'],
            'lang' => 'ru',
            'plugins' => [
                'clips',
                'counter',
                'definedlinks',
                'filemanager',
                'fontcolor',
                'fontfamily',
                'fontsize',
                'fullscreen',
                'imagemanager',
                'limiter',
                'table',
                'textdirection',
                'textexpander',
                'video',
            ]
        ]
    ])?>

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

<?php

use grozzzny\admin\widgets\file_input\ImageInputWidget;
use yii\helpers\Html;
use yii\bootstrap4\ActiveForm;

/* @var $this yii\web\View */
/* @var $model grozzzny\admin\modules\images\models\AdminImageFiles */
/* @var $form yii\bootstrap4\ActiveForm */
?>

<div class="admin-image-files-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'slug')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'file')->widget(ImageInputWidget::className()) ?>

    <?= $form->field($model, 'active')->checkbox([
        'labelOptions' => ['class' => 'custom-control-label'],
        'options' => ['class' => 'custom-control-input'],
        'template' => "<div class=\"custom-control custom-switch\">{input} {label}</div><div>{error}</div>",
    ]) ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

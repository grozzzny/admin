<?php

use grozzzny\admin\widgets\file_input\ImageInputWidget;
use yii\helpers\Html;
use yii\bootstrap4\ActiveForm;

/* @var $this yii\web\View */
/* @var $model grozzzny\admin\modules\testimonials\models\AdminTestimonials */
/* @var $form yii\bootstrap4\ActiveForm */
?>

<div class="admin-testimonials-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'image')->widget(ImageInputWidget::className()) ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'description')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'position')->textInput() ?>

    <?= $form->field($model, 'active')->checkbox() ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

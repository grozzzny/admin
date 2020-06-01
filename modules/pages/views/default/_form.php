<?php

use grozzzny\admin\widgets\file_input\ImageInputWidget;
use yii\helpers\Html;
use yii\bootstrap4\ActiveForm;

/* @var $this yii\web\View */
/* @var $model grozzzny\admin\modules\pages\models\AdminPages */
/* @var $form yii\bootstrap4\ActiveForm */
?>

<div class="admin-pages-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'image')->widget(ImageInputWidget::className()) ?>

    <?= $form->field($model, 'slug')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'text')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'active')->checkbox() ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

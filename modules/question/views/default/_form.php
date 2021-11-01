<?php

use grozzzny\admin\AdminModule;
use yii\helpers\Html;
use yii\bootstrap4\ActiveForm;

/* @var $this yii\web\View */
/* @var $model grozzzny\admin\modules\question\models\AdminQuestion */
/* @var $form yii\bootstrap4\ActiveForm */
?>

<div class="admin-question-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'question')->textarea() ?>

    <?= $form->field($model, 'answer')->textarea() ?>

    <?= $form->field($model, 'active')->checkbox(AdminModule::checkboxSettings()) ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

<?php

use bl\ace\AceWidget;
use yii\helpers\Html;
use yii\bootstrap4\ActiveForm;

/* @var $this yii\web\View */
/* @var $model grozzzny\admin\modules\editable\models\AdminEditable */
/* @var $form yii\bootstrap4\ActiveForm */
?>

<div class="admin-editable-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'code')->widget(AceWidget::className(), [
        'language' => 'html',
        'attributes' => ['style' => 'width: 100%;min-height: 400px;']
    ]);
    ?>

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

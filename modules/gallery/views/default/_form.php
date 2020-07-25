<?php

use grozzzny\admin\components\images\widget\ImagesWidget;
use yii\helpers\Html;
use yii\bootstrap4\ActiveForm;

/* @var $this yii\web\View */
/* @var $model grozzzny\admin\modules\gallery\models\AdminGallery */
/* @var $form yii\bootstrap4\ActiveForm */
?>

<div class="admin-gallery-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'slug')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

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

<?= ImagesWidget::widget(['model' => $model, 'key' => 'gallery'])?>
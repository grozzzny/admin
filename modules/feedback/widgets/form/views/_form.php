<?php

use grozzzny\admin\modules\feedback\widgets\form\FeedbackFormWidget;
use yii\bootstrap4\Alert;
use yii\bootstrap4\Html;
use yii\web\View;

/**
 * @var View $this
 */

?>


<? $form = FeedbackFormWidget::begin()?>

    <?= $form->fieldActive('name')?>

    <?= $form->fieldActive('email')?>

    <?= $form->fieldActive('phone')?>

    <?= $form->fieldActive('message')->textarea()?>

    <?= Alert::widget([
        'options' => ['class' => 'alert-success'],
        'closeButton' => false,
        'body' => Yii::t('app', 'Message sent successfully')
    ])?>

    <?= Html::submitButton()?>

<? FeedbackFormWidget::end()?>
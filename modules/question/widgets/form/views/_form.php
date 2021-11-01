<?php

use grozzzny\admin\modules\question\widgets\form\QuestionFormWidget;
use yii\bootstrap4\Alert;
use yii\bootstrap4\Html;
use yii\web\View;

/**
 * @var View $this
 */

?>


<? $form = QuestionFormWidget::begin()?>

    <?= $form->fieldActive('name')?>

    <?= $form->fieldActive('email')?>

    <?= $form->fieldActive('phone')?>

    <?= $form->fieldActive('question')->textarea()?>

    <?= Alert::widget([
        'options' => ['class' => 'alert-success'],
        'closeButton' => false,
        'body' => Yii::t('app', 'Message sent successfully')
    ])?>

    <?= Html::submitButton()?>

<? QuestionFormWidget::end()?>
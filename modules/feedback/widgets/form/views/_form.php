<?php

use grozzzny\admin\modules\feedback\widgets\form\FeedbackFormWidget;
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

    <?= Html::submitButton()?>

<? FeedbackFormWidget::end()?>
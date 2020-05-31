<?php

use grozzzny\admin\modules\feedback\models\AdminFeedback;
use yii\web\View;

/**
 * @var View $this
 * @var AdminFeedback $model
 */
?>

<p><b><?=$model->getAttributeLabel('name')?>:</b> <?= $model->name ?></p>
<p><b><?=$model->getAttributeLabel('email')?>:</b> <?= $model->email ?></p>
<p><b><?=$model->getAttributeLabel('phone')?>:</b> <?= $model->phone ?></p>
<p><b><?=$model->getAttributeLabel('message')?>:</b> <?= $model->message ?></p>
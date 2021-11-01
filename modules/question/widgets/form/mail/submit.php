<?php

use grozzzny\admin\modules\question\models\AdminQuestion;
use yii\web\View;

/**
 * @var View $this
 * @var AdminQuestion $model
 */
?>

<p><b><?=$model->getAttributeLabel('name')?>:</b> <?= $model->name ?></p>
<p><b><?=$model->getAttributeLabel('email')?>:</b> <?= $model->email ?></p>
<p><b><?=$model->getAttributeLabel('phone')?>:</b> <?= $model->phone ?></p>
<p><b><?=$model->getAttributeLabel('question')?>:</b> <?= $model->question ?></p>
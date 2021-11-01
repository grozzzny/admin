<?php

use grozzzny\admin\modules\question\models\AdminQuestion;
use yii\web\View;

/**
 * @var View $this
 * @var AdminQuestion $model
 */
?>

<p><b><?=$model->getAttributeLabel('question')?>:</b> <?= $model->question ?></p>
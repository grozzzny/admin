<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model grozzzny\admin\modules\carousel\models\AdminCarousel */

$this->title = Yii::t('app', 'Update Admin Carousel: {name}', [
    'name' => $model->title,
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Admin Carousels'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->title, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>


<div class="row page-title-header">
    <div class="col-12">
        <div class="page-header">
            <h4 class="page-title"><?= Html::encode($this->title) ?></h4>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-12 grid-margin">
        <div class="card">
            <div class="card-body">
                <div class="admin-carousel-update">

                    <?= $this->render('_form', [
                        'model' => $model,
                    ]) ?>

                </div>
            </div>
        </div>
    </div>
</div>

<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model grozzzny\admin\modules\social_links\models\AdminSocialLinks */

$this->title = Yii::t('app', 'Create Admin Social Links');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Admin Social Links'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
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

                <div class="admin-social-links-create">

                    <?= $this->render('_form', [
                        'model' => $model,
                    ]) ?>

                </div>

            </div>
        </div>
    </div>
</div>
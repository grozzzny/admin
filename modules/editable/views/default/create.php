<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model grozzzny\admin\modules\editable\models\AdminEditable */

$this->title = Yii::t('app', 'Create Admin Editable');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Admin Editables'), 'url' => ['index']];
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

                <div class="admin-editable-create">

                    <?= $this->render('_form', [
                        'model' => $model,
                    ]) ?>

                </div>

            </div>
        </div>
    </div>
</div>
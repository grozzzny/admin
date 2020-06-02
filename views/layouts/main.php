<?php

/* @var $this \yii\web\View */
/* @var $content string */

use grozzzny\admin\AdminModule;
use grozzzny\admin\assets\AdminAsset;
use yii\helpers\Html;

$asset = AdminAsset::register($this);

Yii::$app->view->params[AdminModule::HIDE_TOOLBAR_PARAM] = true;

?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <?php $this->registerCsrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <link rel="shortcut icon" href="<?=$asset->baseUrl?>/images/favicon.png" />
    <?php $this->head() ?>
</head>
<body>
<?php $this->beginBody() ?>

<div class="container-scroller">

    <?= $this->render('_navbar')?>

    <div class="container-fluid page-body-wrapper">

        <?= $this->render('_sidebar')?>

        <div class="main-panel">

            <div class="content-wrapper">

                <?= $content ?>

            </div>

            <?= $this->render('_footer')?>

        </div>

    </div>

</div>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>

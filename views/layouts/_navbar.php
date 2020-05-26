<?php

use grozzzny\admin\assets\AdminAsset;
use yii\helpers\Url;
use yii\web\View;

/**
 * @var View $this
 */

$asset = AdminAsset::register($this);
?>

<nav class="navbar default-layout col-lg-12 col-12 p-0 fixed-top d-flex flex-row">
    <div class="text-center navbar-brand-wrapper d-flex align-items-top justify-content-center">
        <a class="navbar-brand brand-logo" href="<?= Url::to(['/'])?>">
            <img src="<?=$asset->baseUrl?>/images/logo.svg" alt="logo" /> </a>
        <a class="navbar-brand brand-logo-mini" href="<?= Url::to(['/'])?>">
            <img src="<?=$asset->baseUrl?>/images/logo-mini.svg" alt="logo" /> </a>
    </div>
    <div class="navbar-menu-wrapper d-flex align-items-center">
        <ul class="navbar-nav">
            <li class="nav-item font-weight-semibold d-none d-lg-block"><?=Yii::t('app', 'Admin dashboard')?></li>
        </ul>
        <ul class="navbar-nav ml-auto">
            <li class="nav-item dropdown d-none d-xl-inline-block user-dropdown">
                <a class="nav-link dropdown-toggle" id="UserDropdown" href="#" data-toggle="dropdown" aria-expanded="false">
                    <img class="img-xs rounded-circle" src="<?=$asset->baseUrl?>/images/nophoto.jpeg" alt="Profile image"> </a>
                <div class="dropdown-menu dropdown-menu-right navbar-dropdown" aria-labelledby="UserDropdown">
                    <div class="dropdown-header text-center">
                        <img class="img-md rounded-circle" src="<?=$asset->baseUrl?>/images/nophoto.jpeg" alt="Profile image">
                        <p class="mb-1 mt-3 font-weight-semibold"><?=Yii::$app->user->identity->username?></p>
                    </div>
                    <a href="<?=Url::to(['/admin/default/logout'])?>" class="dropdown-item"><?=Yii::t('app', 'Sign Out')?><i class="dropdown-item-icon ti-power-off"></i></a>
                </div>
            </li>
        </ul>
        <button class="navbar-toggler navbar-toggler-right d-lg-none align-self-center" type="button" data-toggle="offcanvas">
            <span class="mdi mdi-menu"></span>
        </button>
    </div>
</nav>
<?php

use grozzzny\admin\AdminModule;
use grozzzny\admin\components\Nav;
use yii\helpers\ArrayHelper;
use yii\web\View;

/**
 * @var View $this
 */

$module = AdminModule::instance();

$items = [
    $this->render('_item-menu-profile'),
    '<li class="nav-item nav-category">'.Yii::t('app', 'Main Menu').'</li>',
];
?>

<nav class="sidebar sidebar-offcanvas" id="sidebar">
    <?= Nav::widget([
        'items' => ArrayHelper::merge($items, $module->navItems)
    ]) ?>
</nav>
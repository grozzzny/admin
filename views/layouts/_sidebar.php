<?php

use grozzzny\admin\assets\AdminAsset;
use grozzzny\admin\components\Nav;
use yii\helpers\ArrayHelper;
use yii\web\View;

/**
 * @var View $this
 */

$items = [
    $this->render('_item-menu-profile'),
    '<li class="nav-item nav-category">'.Yii::t('app', 'Main Menu').'</li>',
];

$items = ArrayHelper::merge($items, [
    [
        'label' => 'asd1',
        'url' => '/',
        'items' => [
            [
                'label' => 'asd3',
                'url' => '/',
            ],
            [
                'label' => 'asd4',
                'url' => '/',
            ],
            [
                'label' => 'asd5',
                'url' => '/',
            ],
        ]
    ]
]);
?>

<nav class="sidebar sidebar-offcanvas" id="sidebar">
    <?= Nav::widget([
        'items' => $items
    ]) ?>
</nav>
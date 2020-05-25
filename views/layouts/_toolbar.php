<?php

use grozzzny\admin\AdminModule;
use yii\bootstrap4\Nav;
use yii\bootstrap4\NavBar;
use yii\web\View;

/**
 * @var View $this
 */

$module = AdminModule::instance();
$hasLiveEdit = $module->hasLiveEdit();

$css = <<<CSS
    body{
        padding-bottom: 60px;
    }
CSS;

$this->registerCss($css);
?>

<?
NavBar::begin([
    'brandLabel' => Yii::t('app', 'Admin dashboard'),
    'brandUrl' => ['/admin'],
    'options' => [
        'class' => ['navbar', 'navbar-expand-lg', 'navbar-light', 'bg-light', 'fixed-bottom']
    ]
]);
echo Nav::widget([
     'items' => [
         [
             'label' => Yii::t('app', 'Enabled live edit'),
             'url' => ['/admin/default/live-edit-on'],
             'visible' => $hasLiveEdit === false
         ],
         [
             'label' => Yii::t('app', 'Disabled live edit'),
             'url' => ['/admin/default/live-edit-off'],
             'visible' => $hasLiveEdit === true
         ],
         [
             'label' => Yii::t('app', 'Sign Out'),
             'url' => ['/admin/default/logout']
         ],
     ],
     'options' => ['class' => 'navbar-nav'],
]);
NavBar::end();
?>

<?php

use grozzzny\admin\AdminModule;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\web\View;

/**
 * @var View $this
 */

$module = AdminModule::instance();
$hasLiveEdit = $module->hasLiveEdit();

$css = <<<CSS
    body{
        padding-bottom: 51px;
    }
CSS;

$this->registerCss($css);
?>

<?
NavBar::begin([
    'brandLabel' => Yii::t('app', 'Admin dashboard'),
    'brandUrl' => ['/admin'],
    'options' => [
        'class' => ['navbar', 'navbar-default', 'navbar-fixed-bottom', 'navbar-inverse', 'navbar-admin-panel']
    ]//navbar navbar-default navbar-fixed-top
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
     'options' => ['class' => ['navbar-nav', 'nav']],
]);
NavBar::end();
?>

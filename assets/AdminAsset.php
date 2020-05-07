<?php


namespace grozzzny\admin\assets;

class AdminAsset extends \yii\web\AssetBundle
{
    public $sourcePath = '@grozzzny/admin/assets';

    public $css = [
        'vendors/iconfonts/mdi/css/materialdesignicons.min.css',
        'vendors/iconfonts/ionicons/css/ionicons.css',
        'vendors/iconfonts/typicons/src/font/typicons.css',
        'vendors/iconfonts/flag-icon-css/css/flag-icon.min.css',
        'vendors/css/vendor.bundle.base.css',
        'vendors/css/vendor.bundle.addons.css',
        'scss/shared/style.css',
        'scss/admin/style.css',
    ];

    public $js = [
        'vendors/js/vendor.bundle.base.js',
        'vendors/js/vendor.bundle.addons.js',
        'js/shared/off-canvas.js',
        'js/shared/misc.js',
        'js/admin/dashboard.js',
    ];

    public $depends = [
        'yii\web\YiiAsset',
    ];
}

<?php
namespace grozzzny\depends\nested;

use yii\web\View;

class NestedAsset extends \yii\web\AssetBundle
{
    public $sourcePath = '@grozzzny/depends/nested';
    public $js = [
        'js/jquery.fittext.js',
        'js/jquery.nested.js',
    ];
    public $depends = [
        'yii\web\JqueryAsset',
    ];
    public $jsOptions = [
        'position' => View::POS_HEAD
    ];
}

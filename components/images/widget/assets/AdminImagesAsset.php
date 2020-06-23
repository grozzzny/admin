<?php


namespace grozzzny\admin\components\images\widget\assets;


class AdminImagesAsset extends \yii\web\AssetBundle
{
    public $sourcePath = '@grozzzny/admin/components/images/widget/assets';

    public $css = [
        'photos.css',
    ];

    public $js = [
        'photos.js'
    ];

    public $depends = [
        'yii\web\JqueryAsset',
        'grozzzny\depends\glyphicon\GlyphiconAsset',
        'grozzzny\depends\notify\NotifyAsset',
    ];
}
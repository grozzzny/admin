<?php


namespace grozzzny\admin;


use Yii;
use yii\base\Module;

class AdminModule extends Module
{
    public $nav_items = [
        [
            'label' => 'Dashboard demo',
            'url' => 'https://www.bootstrapdash.com/demo/star-admin-free/jquery/src/demo_1/index.html',
        ]
    ];

    public $controllerNamespace = 'grozzzny\admin\controllers';

    public $layout = 'main';

    /**
     * @return self|Module|null
     */
    public static function instance()
    {
        return Yii::$app->getModule('admin');
    }
}
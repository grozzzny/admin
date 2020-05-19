<?php


namespace grozzzny\admin;


use Yii;
use yii\base\Module;

class AdminModule extends Module
{
    const LIVE_EDIT_KEY = 'live_edit';

    public $live_edit_role = '@';

    public $nav_items = [
        [
            'label' => 'Dashboard demo',
            'url' => 'https://www.bootstrapdash.com/demo/star-admin-free/jquery/src/demo_1/index.html',
        ]
    ];

    public $controllerNamespace = 'grozzzny\admin\controllers';

    public $layout = 'main';

    public function hasLiveEdit()
    {
        return Yii::$app->session->has(self::LIVE_EDIT_KEY);
    }

    public function enabledLiveEdit()
    {
        return Yii::$app->session->set(self::LIVE_EDIT_KEY, true);
    }

    public function disabledLiveEdit()
    {
        return Yii::$app->session->remove(self::LIVE_EDIT_KEY);
    }

    /**
     * @return self|Module|null
     */
    public static function instance()
    {
        return Yii::$app->getModule('admin');
    }
}
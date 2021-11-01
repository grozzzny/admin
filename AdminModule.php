<?php


namespace grozzzny\admin;


use Yii;
use yii\base\Module;
use yii\web\View;

/**
 * Class AdminModule
 * @package grozzzny\admin
 *
 * @property-read array $navItems
 */
class AdminModule extends Module
{
    const HIDE_TOOLBAR_PARAM = 'hide_toolbar_param';

    const LIVE_EDIT_KEY = 'live_edit';

    public $live_edit_role = '@';

    public $render_toolbar_role = '@';

    public $view_path_toolbar = '@grozzzny/admin/views/layouts/_toolbar';

    public $nav_items = [
        [
            'label' => 'Dashboard demo',
            'url' => 'https://www.bootstrapdash.com/demo/star-admin-free/jquery/src/demo_1/index.html',
        ]
    ];

    /**
     * @var array the class map. How the container should load specific classes
     * @see Bootstrap::buildClassMap() for more details
     */
    public $classMap = [];

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

    public function getNavItems()
    {
        $nav_items = $this->nav_items;

        return $nav_items instanceof \Closure ? $nav_items() : $nav_items;
    }

    protected function renderToolbar()
    {
        if(!static::can($this->render_toolbar_role) || isset(Yii::$app->view->params[static::HIDE_TOOLBAR_PARAM])) return false;

        echo Yii::$app->view->render($this->view_path_toolbar);
    }

    public static function checkboxSettings()
    {
        return [
            'labelOptions' => ['class' => 'custom-control-label'],
            'options' => ['class' => 'custom-control-input'],
            'template' => "<div class=\"custom-control custom-switch\">{input} {label}</div><div>{error}</div>",
        ];
    }

    public static function can($permissionName)
    {
        if ($permissionName === '?') {
            if (Yii::$app->user->isGuest) {
                return true;
            }
        } elseif ($permissionName === '@') {
            if (!Yii::$app->user->isGuest) {
                return true;
            }
        } else {
            return Yii::$app->user->can($permissionName);
        }
    }
}
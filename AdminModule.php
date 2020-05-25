<?php


namespace grozzzny\admin;


use Yii;
use yii\base\BootstrapInterface;
use yii\base\Module;
use yii\web\View;

class AdminModule extends Module implements BootstrapInterface
{
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

    public function bootstrap($app)
    {
        $app->view->on(View::EVENT_END_BODY, [$this, 'renderToolbar']);
    }

    protected function renderToolbar()
    {
        if(!static::can($this->render_toolbar_role) || strpos(Yii::$app->request->pathInfo, 'admin') !== false) return false;

        echo Yii::$app->view->render($this->view_path_toolbar);
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
<?php

namespace grozzzny\admin\controllers;

use grozzzny\admin\AdminModule;
use Yii;
use yii\web\Controller;


class DefaultController extends Controller
{
    public function actionIndex()
    {
        return $this->render('index');
    }

    public function actionLiveEditOn()
    {
        $module = AdminModule::instance();
        $module->enabledLiveEdit();
        return $this->redirect(Yii::$app->request->referrer);
    }

    public function actionLiveEditOff()
    {
        $module = AdminModule::instance();
        $module->disabledLiveEdit();
        return $this->redirect(Yii::$app->request->referrer);
    }

    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }
}

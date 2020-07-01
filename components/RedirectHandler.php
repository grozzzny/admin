<?php


namespace grozzzny\admin\components;


use Yii;
use yii\base\BaseObject;

class RedirectHandler extends BaseObject
{
    public static function run($event)
    {
        if(Yii::$app->request->isSecureConnection) return;

        $url = Yii::$app->request->absoluteUrl;
        $url = str_replace('http:', 'https:', $url);
        Yii::$app->response->redirect($url);
        Yii::$app->end();
    }
}
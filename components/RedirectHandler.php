<?php


namespace grozzzny\admin\components;


use Yii;
use yii\base\BaseObject;

class RedirectHandler extends BaseObject
{
    public function run($event)
    {
        if(!Yii::$app->request->isSecureConnection){
            $url = Yii::$app->request->absoluteUrl;
            $url = str_replace('http:', 'https:', $url);
            Yii::$app->response->redirect($url);
            Yii::$app->end();
        }
    }
}
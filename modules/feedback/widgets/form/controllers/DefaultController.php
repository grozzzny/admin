<?php


namespace grozzzny\admin\modules\feedback\widgets\form\controllers;

use grozzzny\admin\modules\feedback\models\AdminFeedback;
use Yii;
use yii\base\Exception;
use yii\web\Controller;
use yii\web\Response;
use yii\widgets\ActiveForm;

class DefaultController extends Controller
{
    public function behaviors()
    {
        return [
            [
                'class' => 'yii\filters\AjaxFilter',
                'only' => ['validate', 'submit']
            ],
            [
                'class' => 'yii\filters\ContentNegotiator',
                'only' => ['validate', 'submit'],
                'formats' => [
                    'application/json' => Response::FORMAT_JSON,
                ]
            ],
            [
                'class' => 'yii\filters\VerbFilter',
                'actions' => [
                    'validate' => ['POST'],
                    'submit' => ['POST'],
                ]
            ]
        ];
    }

    public function actionValidate()
    {
        $model = $this->model();
        if ($model->load(Yii::$app->request->post())) {
//            Yii::$app->response->format = Response::FORMAT_JSON;
            return ActiveForm::validate($model);
        }
    }

    public function actionSubmit()
    {
        $model = $this->model();
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
//            Yii::$app->response->format = Response::FORMAT_JSON;
            if($model->save()) {
                return true;
            } else {
                throw new Exception(Yii::t('yii', 'Error'));
            }
        }
    }

    protected function model()
    {
        return Yii::createObject(['class' => AdminFeedback::className()]);
    }
}
<?php


namespace grozzzny\admin\modules\feedback\widgets\form\controllers;

use grozzzny\admin\modules\feedback\models\AdminFeedback;
use grozzzny\admin\modules\feedback\widgets\form\events\SubmitEvent;
use Yii;
use yii\base\Exception;
use yii\web\Controller;
use yii\web\Response;
use yii\widgets\ActiveForm;

class DefaultController extends Controller
{
    const EVENT_SUBMIT = 'submit';

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
            return ActiveForm::validate($model);
        }
    }

    public function actionSubmit()
    {
        $model = $this->model();
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            if($model->save()) {
                $event = Yii::createObject(['class' => SubmitEvent::className(), 'model' => $model]);
                $this->trigger(static::EVENT_SUBMIT, $event);
                return true;
            } else {
                throw new Exception(Yii::t('app', 'Error save: {0}', json_encode($model->errors, JSON_UNESCAPED_UNICODE)));
            }
        }
    }

    protected function model()
    {
        return Yii::createObject(['class' => AdminFeedback::className()]);
    }
}
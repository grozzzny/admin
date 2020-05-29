<?php


namespace grozzzny\admin\modules\feedback\widgets\form;


use grozzzny\admin\modules\feedback\models\AdminFeedback;
use Yii;
use yii\bootstrap4\ActiveForm;


class FeedbackFormWidget extends ActiveForm
{
    public $action = [];

    /** @var AdminFeedback */
    public $model;

    public function init()
    {
        parent::init();
        $this->model = Yii::createObject(['class' => AdminFeedback::className()]);
    }

    public function fieldActive($attribute, $options = [])
    {
        return parent::field($this->model, $attribute, $options);
    }
}
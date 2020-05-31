<?php


namespace grozzzny\admin\modules\feedback\widgets\form\events;


use grozzzny\admin\modules\feedback\models\AdminFeedback;
use yii\base\Event;

class SubmitEvent extends Event
{
    /** @var AdminFeedback */
    public $model;
}
<?php


namespace grozzzny\admin\modules\question\widgets\form\events;


use grozzzny\admin\modules\question\models\AdminQuestion;
use yii\base\Event;

class SubmitEvent extends Event
{
    /** @var AdminQuestion */
    public $model;
}
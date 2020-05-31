<?php


namespace grozzzny\admin\modules\feedback\widgets\form\components;


use grozzzny\admin\modules\feedback\widgets\form\events\SubmitEvent;
use Yii;
use yii\base\BaseObject;

class SubmitHandler extends BaseObject
{
    /**
     * @param SubmitEvent $event
     */
    public static function submit($event)
    {
        Yii::$app->mailer->compose('@vendor/grozzzny/admin/modules/feedback/widgets/form/mail/submit', ['model' => $event->model])
            ->setFrom([Yii::$app->params['senderEmail'] => Yii::$app->params['senderName']])
            ->setTo(Yii::$app->params['adminEmail'])
            ->setSubject(Yii::t('app', 'Message from the site using the feedback form'))
            ->send();
    }
}
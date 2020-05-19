<?php


namespace grozzzny\admin\widgets;


use grozzzny\admin\AdminModule;
use Yii;
use yii\base\Widget;
use yii\helpers\Html;

/**
 * Class LiveEditWidget
 * @package grozzzny\admin\widgets
 *
 * @property-read AdminModule $module
 */
class LiveEditWidget extends Widget
{
    protected function renderLinkCreate($url)
    {
        $label = Yii::t('app', 'Create text');

        return Html::a($label, $url, ['target' => '_blank']);
    }

    protected function renderLinkUpdate($url, $text)
    {
        return Html::tag('span', $text, [
            'class' => 'admin-live-edit',
            'onclick' => 'location.href = "'.$url.'"'
        ]);
    }

    protected function getModule()
    {
        return AdminModule::instance();
    }

    protected function access()
    {
        return Yii::$app->user->can($this->module->live_edit_role);
    }
}
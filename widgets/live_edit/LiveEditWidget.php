<?php


namespace grozzzny\admin\widgets\live_edit;


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
    protected function renderAdminLinks($text, $linkCreate, $linkUpdate)
    {
        if(!$this->access()) return $text;

        if(empty($text)) return $this->renderLinkCreate($linkCreate);

        if($this->module->hasLiveEdit()) return $this->renderLinkUpdate($linkUpdate, $text);

        return $text;
    }

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
        $module = $this->module;
        return $module::can($module->live_edit_role);
    }
}
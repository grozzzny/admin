<?php


namespace grozzzny\admin\widgets\live_edit;


use grozzzny\admin\AdminModule;
use Yii;
use yii\base\Widget;
use yii\helpers\Html;
use yii\helpers\Url;

/**
 * Class LiveEditWidget
 * @package grozzzny\admin\widgets
 *
 * @property-read AdminModule $module
 */
class LiveEditWidget extends Widget
{
    public $label;

    public function init()
    {
        $this->view->registerAssetBundle(LiveEditAsset::className());
        parent::init();
    }

    protected function renderAdminLinks($text, $linkCreate, $linkUpdate)
    {
        if(!$this->access()) return $text;

        if(empty($text)) return $this->renderLinkCreate($linkCreate);

        if($this->module->hasLiveEdit()) return $this->renderLinkUpdate($linkUpdate, $text);

        return $text;
    }

    protected function renderLinkCreate($url)
    {
        $label = empty($this->label) ? Yii::t('app', 'Create text') : $this->label;

        return $this->renderLink($url, $label);
    }

    protected function renderLinkUpdate($url, $text)
    {
        return $this->renderLink($url, $text);
    }

    protected function renderLink($url, $text)
    {
        return Html::tag('span', $text, [
            'class' => 'admin-live-edit',
            'onclick' => 'window.open("'.Url::to($url).'", "_blank")'
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
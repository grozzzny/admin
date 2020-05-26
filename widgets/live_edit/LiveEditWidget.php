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
    public $text;
    public $linkCreate = [];
    public $linkUpdate = [];

    public function init()
    {
        $this->view->registerAssetBundle(LiveEditAsset::className());
        parent::init();
    }

    public function run()
    {
        return $this->renderAdminLinks($this->text, $this->linkCreate, $this->linkUpdate);
    }

    protected function renderAdminLinks($text, $linkCreate, $linkUpdate)
    {
        if(!$this->access()) return empty($text) ? $this->getLabel() : $text;

        if($this->module->hasLiveEdit()) {
            if(empty($text)) return $this->renderLinkCreate($linkCreate);

            return $this->renderLinkUpdate($linkUpdate, $text);
        }

        return empty($text) ? $this->getLabel() : $text;
    }

    protected function renderLinkCreate($url)
    {
        $label = $this->getLabel();

        return $this->renderLink($url, $label);
    }

    protected function getLabel()
    {
        return empty($this->label) ? Yii::t('app', 'Create text') : $this->label;
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
<?php


namespace grozzzny\admin\modules\text;


use grozzzny\admin\modules\text\models\AdminText;
use grozzzny\admin\widgets\LiveEditWidget;

/**
 * Class LiveEditText
 * @package grozzzny\admin\modules\text
 *
 * @property-read string|null $text
 */
class LiveEditText extends LiveEditWidget
{
    public $slug;

    public function run()
    {
        $text = $this->text;

        if($this->access()){
            if(empty($text)) return $this->renderLinkCreate([]);
            if($this->module->hasLiveEdit()) $text = $this->renderLinkUpdate([], $text);
        }

        return $text;
    }

    protected function getText()
    {
        $model = AdminText::findOne(['slug' => $this->slug]);

        return $model->text;
    }
}
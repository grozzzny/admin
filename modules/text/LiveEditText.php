<?php


namespace grozzzny\admin\modules\text;


use grozzzny\admin\modules\text\models\AdminText;
use grozzzny\admin\widgets\live_edit\LiveEditWidget;

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

        return $this->renderAdminLinks($text, ['/admin/text/default/create', 'slug' => $this->slug], ['/admin/text/default/update', 'slug' => $this->slug]);
    }

    protected function getText()
    {
        $model = AdminText::findOne(['slug' => $this->slug]);

        return $model->text;
    }
}
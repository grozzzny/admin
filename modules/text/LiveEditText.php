<?php


namespace grozzzny\admin\modules\text;


use grozzzny\admin\modules\text\models\AdminText;
use grozzzny\admin\widgets\live_edit\LiveEditWidget;
use Yii;

/**
 * Class LiveEditText
 * @package grozzzny\admin\modules\text
 *
 * @property-read string|null $textModel
 */
class LiveEditText extends LiveEditWidget
{
    public $slug;

    public function run()
    {
        $text = $this->textModel;

        return $this->renderAdminLinks($text, ['/admin/text/default/create', 'slug' => $this->slug], ['/admin/text/default/update', 'slug' => $this->slug]);
    }

    protected function getTextModel()
    {
        /** @var AdminText $instance */
        $instance = Yii::$container->get(AdminText::class);

        $model = $instance::findOne(['slug' => $this->slug]);

        return $model->text;
    }
}
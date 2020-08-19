<?php
namespace grozzzny\admin\modules\editable\widgets;

use grozzzny\admin\modules\editable\models\AdminEditable;
use yii\base\Widget;

class EditableWidget extends Widget
{
    public function run()
    {
        $html = '';

        foreach (AdminEditable::findAll(['active' => true]) as $model) $html .= $model->code . PHP_EOL;

        return $html;
    }
}
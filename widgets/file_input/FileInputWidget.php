<?php


namespace grozzzny\admin\widgets\file_input;


use yii\helpers\Html;
use yii\widgets\InputWidget;

class FileInputWidget extends InputWidget
{

    public function init()
    {
        parent::init();

        $this->field->form->options['enctype'] = 'multipart/form-data';
    }

    public function run()
    {
        if($this->model->{$this->attribute}){
            echo Html::tag('div', $this->model->{$this->attribute}, $this->field->options);
        }

        echo Html::activeFileInput($this->model, $this->attribute, ['style' => 'width: 100%;']);
    }

}
<?php


namespace grozzzny\admin\widgets\file_input;


use yii\helpers\Html;
use yii\widgets\InputWidget;

class ImageInputWidget extends InputWidget
{

    public function init()
    {
        parent::init();

        $this->field->form->options['enctype'] = 'multipart/form-data';
    }

    public function run()
    {
        if($this->model->{$this->attribute}){
            $img = Html::img($this->model->{$this->attribute}, ['style' => ['width' => '240px']]);
            echo Html::tag('div', $img, $this->field->options);
        }

        echo Html::activeFileInput($this->model, $this->attribute, ['style' => 'width: 100%;']);
    }

}
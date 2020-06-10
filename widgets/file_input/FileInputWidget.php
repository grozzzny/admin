<?php


namespace grozzzny\admin\widgets\file_input;


use Yii;
use yii\helpers\Html;
use yii\widgets\InputWidget;

class FileInputWidget extends InputWidget
{
    public $urlDelete;

    public $urlDeleteOptions = [];
    public $urlOptions = [];

    public $url;

    public function init()
    {
        parent::init();

        $this->field->form->options['enctype'] = 'multipart/form-data';
    }

    public function run()
    {
        if($this->model->{$this->attribute}){
            echo Html::beginTag('div', $this->field->options);
            if(empty($this->url)){
                echo $this->model->{$this->attribute};
            } else {
                echo Html::a($this->model->{$this->attribute}, $this->url, $this->urlOptions);
            }

            if(!empty($this->urlDelete)){
                echo Html::a(' ('.Yii::t('app', 'Delete').')', $this->urlDelete, $this->urlDeleteOptions);
            }
            echo Html::endTag('div');
        }

        echo Html::activeFileInput($this->model, $this->attribute, ['style' => 'width: 100%;']);
    }

}
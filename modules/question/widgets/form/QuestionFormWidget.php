<?php


namespace grozzzny\admin\modules\question\widgets\form;


use grozzzny\admin\modules\question\models\AdminQuestion;
use Yii;
use yii\bootstrap4\ActiveForm;


class QuestionFormWidget extends ActiveForm
{
    public $enableAjaxValidation = true;
    public $validationUrl = ['/question/validate'];
    public $action = ['/question/submit'];
    public $alertSelector = '.js-alert';

    /** @var AdminQuestion */
    public $model;

    public function init()
    {
        parent::init();

        $this->registerJs();

        $this->model = $this->model();
    }

    public function fieldActive($attribute, $options = [])
    {
        return parent::field($this->model, $attribute, $options);
    }

    public function registerJs()
    {
        $js = <<<JS
            var form = $('#$this->id');
            var alert = form.find('$this->alertSelector');

            form.on('submit', function (event) {
                event.preventDefault();
            });
            
            form.on('beforeSubmit', function (event) {
                $.ajax({
                    url: form.attr('action'),
                    type: 'POST',
                    data: form.serialize(),
                    success: function(response)
                    {
                        if(response) {
                            alert.show();
                            setTimeout(function() {
                                alert.hide();
                            }, 3000);
                            form.trigger('reset');
                        } else {
                            console.error('Error save');
                        }
                    }
                });
                
                return false;
            });
JS;
        $this->view->registerJs($js);
    }

    protected function model()
    {
        return Yii::createObject(['class' => AdminQuestion::className()]);
    }
}
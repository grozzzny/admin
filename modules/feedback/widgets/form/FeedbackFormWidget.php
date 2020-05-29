<?php


namespace grozzzny\admin\modules\feedback\widgets\form;


use grozzzny\admin\modules\feedback\models\AdminFeedback;
use Yii;
use yii\bootstrap4\ActiveForm;


class FeedbackFormWidget extends ActiveForm
{
    public $enableAjaxValidation = true;
    public $validationUrl = ['/feedback/validate'];
    public $action = ['/feedback/submit'];
    public $alertSelector = '.js-alert';

    /** @var AdminFeedback */
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
        return Yii::createObject(['class' => AdminFeedback::className()]);
    }
}
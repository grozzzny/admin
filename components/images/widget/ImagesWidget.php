<?php
namespace grozzzny\admin\components\images\widget;

use grozzzny\admin\components\images\AdminImages;
use grozzzny\admin\components\images\widget\assets\AdminImagesAsset;
use Yii;
use yii\base\Widget;
use yii\base\InvalidConfigException;

class ImagesWidget extends Widget
{
    public $model;
    public $key;

    public function init()
    {
        parent::init();

        if (empty($this->model)) {
            throw new InvalidConfigException('Required `model` param isn\'t set.');
        }

        $this->view->registerAssetBundle(AdminImagesAsset::class);
    }

    public function run()
    {
        /** @var AdminImages $model */
        $model = Yii::$container->get(AdminImages::class);

        $images = $model::find()->where(['key' => $this->key, 'item_id' => $this->model->primaryKey])->all();

        echo $this->render('index', [
            'images' => $images
        ]);
    }

}
<?php
namespace grozzzny\admin\components\images\widget;

use grozzzny\admin\components\images\AdminImages;
use grozzzny\admin\components\images\widget\assets\AdminImagesAsset;
use Yii;
use yii\base\Widget;
use yii\base\InvalidConfigException;
use yii\db\ActiveRecord;

class ImagesWidget extends Widget
{
    const PHOTO_MAX_WIDTH = 1900;
    const PHOTO_THUMB_WIDTH = 300;
    const PHOTO_THUMB_HEIGHT = 250;

    /**
     * @var ActiveRecord
     */
    public $model;
    public $key;

    public $url_upload = ['/admin-images/upload'];
    public $url_data = '/admin-images/data?id={{photo_id}}';
    public $url_change = '/admin-images/change?id={{photo_id}}';
    public $url_delete = '/admin-images/delete?id={{photo_id}}';
    public $enable_description = true;
    public $enable_author = true;

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
        if($this->model->isNewRecord) return false;

        /** @var AdminImages $model */
        $model = Yii::$container->get(AdminImages::class);

        $images = $model::find()->where(['key' => $this->key, 'item_id' => $this->model->primaryKey])->all();

        echo $this->render('index', [
            'images' => $images
        ]);
    }

}
<?php

namespace grozzzny\admin\components\seo;

use grozzzny\admin\helpers\Image;
use grozzzny\admin\widgets\file_input\components\FileBehavior;
use Yii;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "admin_seo".
 *
 * @property int $id
 * @property string|null $key
 * @property int|null $item_id
 * @property string|null $h1
 * @property string|null $title
 * @property string|null $keywords
 * @property string|null $description
 * @property string|null $image
 */
class AdminSeo extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'admin_seo';
    }

    public function behaviors()
    {
        return ArrayHelper::merge(parent::behaviors(), [
            'image' => [
                'class' => FileBehavior::className(),
                'fileAttribute' => 'image',
                'uploadPath' => '/uploads/seo',
            ],
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['h1', 'title', 'keywords', 'description'], 'trim'],
            [['image'], 'image'],
            [['item_id'], 'integer'],
            [['key', 'h1', 'title', 'keywords', 'description'], 'string', 'max' => 255],
            [['key', 'item_id'], 'unique', 'targetAttribute' => ['key', 'item_id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'key' => Yii::t('app', 'Key'),
            'item_id' => Yii::t('app', 'Item ID'),
            'h1' => Yii::t('app', 'H1'),
            'title' => Yii::t('app', 'Title'),
            'keywords' => Yii::t('app', 'Keywords'),
            'description' => Yii::t('app', 'Description'),
            'image' => Yii::t('app', 'Image'),
        ];
    }

    public function getImage($width = null, $height = null)
    {
        if(!isset(Yii::$app->params['noimage'])) return Image::thumb($this->image, $width, $height);

        $path = empty($this->image) ? Yii::$app->params['noimage'] : $this->image;

        $image = Image::thumb($path, $width, $height);

        return empty($image) ? Image::thumb(Yii::$app->params['noimage'], $width, $height) : $image;
    }

    public function get($attribute, $default = ''){
        return !empty($this->{$attribute}) ? $this->{$attribute} : $default;
    }
}

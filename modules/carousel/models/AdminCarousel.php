<?php

namespace grozzzny\admin\modules\carousel\models;

use grozzzny\admin\helpers\Image;
use grozzzny\admin\widgets\file_input\components\FileBehavior;
use grozzzny\admin\widgets\live_edit\LiveEditWidget;
use Yii;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "admin_carousel".
 *
 * @property int $id
 * @property string|null $image
 * @property string|null $link
 * @property string|null $title
 * @property string|null $text
 * @property int|null $position
 * @property int|null $active
 * @property-read string $liveEditTitle
 */
class AdminCarousel extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'admin_carousel';
    }

    public function behaviors()
    {
        return ArrayHelper::merge(parent::behaviors(), [
            'image' => [
                'class' => FileBehavior::className(),
                'fileAttribute' => 'image',
                'uploadPath' => '/uploads/carousel',
            ],
            'position' => [
                'class' => 'grozzzny\admin\behaviors\PositionBehavior',
                'attribute' => 'position'
            ]
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['image'], 'image'],
            [['position'], 'integer'],
            [['active'], 'boolean'],
            [['active'], 'default', 'value' => true],
            [['link', 'title', 'text'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'image' => Yii::t('app', 'Image'),
            'link' => Yii::t('app', 'Link'),
            'title' => Yii::t('app', 'Title'),
            'text' => Yii::t('app', 'Text'),
            'position' => Yii::t('app', 'Position'),
            'active' => Yii::t('app', 'Active'),
        ];
    }

    public function getImage($width = null, $height = null)
    {
        if(!isset(Yii::$app->params['noimage'])) return Image::thumb($this->image, $width, $height);

        $path = empty($this->image) ? Yii::$app->params['noimage'] : $this->image;

        $image = Image::thumb($path, $width, $height);

        return empty($image) ? Image::thumb(Yii::$app->params['noimage'], $width, $height) : $image;
    }

    public function getLiveEditTitle()
    {
        return LiveEditWidget::widget([
            'text' => $this->title,
            'linkCreate' => ['/admin/carousel/default/create'],
            'linkUpdate' => ['/admin/carousel/default/update', 'id' => $this->primaryKey]
        ]);
    }
}

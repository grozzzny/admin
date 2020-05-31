<?php

namespace grozzzny\admin\modules\features\models;

use grozzzny\admin\helpers\Image;
use grozzzny\admin\widgets\file_input\components\FileBehavior;
use grozzzny\admin\widgets\live_edit\LiveEditWidget;
use Yii;
use yii\behaviors\BlameableBehavior;
use yii\behaviors\TimestampBehavior;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "admin_features".
 *
 * @property int $id
 * @property string|null $icon
 * @property string|null $image
 * @property string|null $title
 * @property string|null $description
 * @property string|null $link
 * @property int|null $position
 * @property int|null $active
 *
 * @property-read string $liveEditTitle
 */
class AdminFeatures extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'admin_features';
    }

    public function behaviors()
    {
        return ArrayHelper::merge(parent::behaviors(), [
            'image' => [
                'class' => FileBehavior::className(),
                'fileAttribute' => 'image',
                'uploadPath' => '/uploads/features',
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
            [['title'], 'required'],
            [['active'], 'boolean'],
            [['active'], 'default', 'value' => true],
            [['icon', 'title', 'description', 'link'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'icon' => Yii::t('app', 'Icon'),
            'image' => Yii::t('app', 'Image'),
            'title' => Yii::t('app', 'Title'),
            'description' => Yii::t('app', 'Description'),
            'link' => Yii::t('app', 'Link'),
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
            'linkCreate' => ['/admin/features/default/create'],
            'linkUpdate' => ['/admin/features/default/update', 'id' => $this->primaryKey]
        ]);
    }
}

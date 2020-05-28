<?php

namespace grozzzny\admin\modules\testimonials\models;

use grozzzny\admin\helpers\Image;
use grozzzny\admin\widgets\file_input\components\FileBehavior;
use grozzzny\admin\widgets\live_edit\LiveEditWidget;
use Yii;
use yii\behaviors\BlameableBehavior;
use yii\behaviors\TimestampBehavior;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "admin_testimonials".
 *
 * @property int $id
 * @property string|null $image
 * @property string|null $name
 * @property string|null $description
 * @property int|null $position
 * @property int|null $active
 * @property int|null $created_at
 * @property int|null $updated_at
 * @property int|null $created_by
 * @property int|null $updated_by
 *
 * @property-read string $liveEditDescription
 */
class AdminTestimonials extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'admin_testimonials';
    }

    public function behaviors()
    {
        return ArrayHelper::merge(parent::behaviors(), [
            BlameableBehavior::className(),
            TimestampBehavior::className(),
            'image' => [
                'class' => FileBehavior::className(),
                'fileAttribute' => 'image',
                'uploadPath' => '/uploads/testimonials',
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
            [['active'], 'default', 'value' => true],
            [['position', 'active', 'created_at', 'updated_at', 'created_by', 'updated_by'], 'integer'],
            [['name', 'description'], 'string', 'max' => 255],
            [['description'], 'required'],
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
            'name' => Yii::t('app', 'Name'),
            'description' => Yii::t('app', 'Description'),
            'position' => Yii::t('app', 'Position'),
            'active' => Yii::t('app', 'Active'),
            'created_at' => Yii::t('app', 'Created At'),
            'updated_at' => Yii::t('app', 'Updated At'),
            'created_by' => Yii::t('app', 'Created By'),
            'updated_by' => Yii::t('app', 'Updated By'),
        ];
    }

    public function getImage($width = null, $height = null)
    {
        if(!isset(Yii::$app->params['noimage'])) return Image::thumb($this->image, $width, $height);

        $path = empty($this->image) ? Yii::$app->params['noimage'] : $this->image;

        $image = Image::thumb($path, $width, $height);

        return empty($image) ? Image::thumb(Yii::$app->params['noimage'], $width, $height) : $image;
    }

    public function getLiveEditDescription()
    {
        return LiveEditWidget::widget([
            'text' => $this->description,
            'linkCreate' => ['/admin/testimonials/default/create'],
            'linkUpdate' => ['/admin/testimonials/default/update', 'id' => $this->primaryKey]
        ]);
    }
}

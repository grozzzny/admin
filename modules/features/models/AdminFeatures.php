<?php

namespace grozzzny\admin\modules\features\models;

use grozzzny\admin\widgets\file_input\components\FileBehavior;
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
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['image'], 'file', 'extensions' => 'png, jpg'],
            [['position', 'active'], 'integer'],
            [['title'], 'required'],
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
}

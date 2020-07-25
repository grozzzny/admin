<?php

namespace grozzzny\admin\modules\gallery\models;

use grozzzny\admin\components\images\AdminImages;
use grozzzny\admin\components\images\AdminImagesBehavior;
use Yii;
use yii\behaviors\SluggableBehavior;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "admin_gallery".
 *
 * @property int $id
 * @property string|null $slug
 * @property string|null $name
 * @property int|null $active
 * @property-read AdminImages[] $images
 */
class AdminGallery extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'admin_gallery';
    }

    public function behaviors()
    {
        return ArrayHelper::merge(parent::behaviors(), [
            'slug' => [
                'class' => SluggableBehavior::className(),
                'attribute' => 'name'
            ],
            'images' => [
                'class' => AdminImagesBehavior::class,
                'key' => 'gallery'
            ]
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['active'], 'integer'],
            [['slug', 'name'], 'string', 'max' => 255],
            [['slug', 'name'], 'string', 'max' => 255],
            [['slug'], 'match', 'pattern' => '/[A-z\-_]+/'],
            [['name'], 'required'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'slug' => Yii::t('app', 'Slug'),
            'name' => Yii::t('app', 'Name'),
            'active' => Yii::t('app', 'Active'),
        ];
    }
}

<?php

namespace grozzzny\admin\modules\testimonials\models;

use Yii;

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

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['position', 'active', 'created_at', 'updated_at', 'created_by', 'updated_by'], 'integer'],
            [['image', 'name', 'description'], 'string', 'max' => 255],
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
}

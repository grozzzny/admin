<?php

namespace grozzzny\admin\modules\settings\models;

use Yii;
use yii\behaviors\SluggableBehavior;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "admin_settings".
 *
 * @property int $id
 * @property string|null $slug
 * @property string|null $name
 * @property string|null $value
 */
class AdminSettings extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'admin_settings';
    }

    public function behaviors()
    {
        return ArrayHelper::merge(parent::behaviors(), [
            'slug' => [
                'class' => SluggableBehavior::className(),
                'attribute' => 'name'
            ],
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['value'], 'string'],
            [['slug', 'name'], 'string', 'max' => 255],
            [['slug'], 'match', 'pattern' => '/[A-z\-_]+/'],
            [['name', 'value'], 'required'],
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
            'value' => Yii::t('app', 'Value'),
        ];
    }

    public static function get($slug)
    {
        $model = static::findOne(['slug' => $slug]);

        return empty($model) ? Yii::createObject(['class' => static::className(), 'slug' => $slug]) : $model;
    }
}

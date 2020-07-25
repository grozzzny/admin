<?php

namespace grozzzny\admin\modules\files\models;

use Yii;

/**
 * This is the model class for table "admin_files".
 *
 * @property int $id
 * @property string|null $slug
 * @property string|null $name
 * @property string|null $file
 * @property int|null $active
 */
class AdminFiles extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'admin_files';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['active'], 'integer'],
            [['slug', 'name', 'file'], 'string', 'max' => 255],
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
            'file' => Yii::t('app', 'File'),
            'active' => Yii::t('app', 'Active'),
        ];
    }
}

<?php

namespace grozzzny\admin\modules\editable\models;

use Yii;

/**
 * This is the model class for table "admin_editable".
 *
 * @property int $id
 * @property string|null $name
 * @property string|null $code
 * @property int|null $active
 */
class AdminEditable extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'admin_editable';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['code'], 'string'],
            [['active'], 'integer'],
            [['name'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'name' => Yii::t('app', 'Name'),
            'code' => Yii::t('app', 'Code'),
            'active' => Yii::t('app', 'Active'),
        ];
    }
}

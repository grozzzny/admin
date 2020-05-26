<?php

namespace grozzzny\admin\modules\social_links\models;

use Yii;

/**
 * This is the model class for table "admin_social_links".
 *
 * @property int $id
 * @property string|null $title
 * @property string|null $link
 * @property string|null $icon
 * @property int|null $position
 * @property int|null $active
 */
class AdminSocialLinks extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'admin_social_links';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['position', 'active'], 'integer'],
            [['title', 'link', 'icon'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'title' => Yii::t('app', 'Title'),
            'link' => Yii::t('app', 'Link'),
            'icon' => Yii::t('app', 'Icon'),
            'position' => Yii::t('app', 'Position'),
            'active' => Yii::t('app', 'Active'),
        ];
    }
}

<?php

namespace grozzzny\admin\modules\pages\models;

use grozzzny\admin\components\seo\AdminSeo;
use grozzzny\admin\components\seo\AdminSeoBehavior;
use grozzzny\admin\helpers\Image;
use grozzzny\admin\widgets\file_input\components\FileBehavior;
use grozzzny\admin\widgets\live_edit\LiveEditWidget;
use Yii;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "admin_pages".
 *
 * @property int $id
 * @property string|null $slug
 * @property string|null $image
 * @property string|null $name
 * @property string|null $text
 * @property int|null $active
 *
 * @property-read string $liveEditText
 * @property-read string $liveEditName
 *
 * @property-read AdminSeo $seo
 */
class AdminPages extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'admin_pages';
    }

    public function behaviors()
    {
        return ArrayHelper::merge(parent::behaviors(), [
            'image' => [
                'class' => FileBehavior::className(),
                'fileAttribute' => 'image',
                'uploadPath' => '/uploads/pages',
            ],
            'seo' => [
                'class' => AdminSeoBehavior::className(),
                'key' => 'pages',
            ],
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['image'], 'image'],
            [['text'], 'string'],
            [['active'], 'integer'],
            [['slug', 'name'], 'string', 'max' => 255],
            [['slug'], 'match', 'pattern' => '/[A-z\-_]+/'],
            [['slug', 'name'], 'required'],
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
            'image' => Yii::t('app', 'Image'),
            'name' => Yii::t('app', 'Name'),
            'text' => Yii::t('app', 'Text'),
            'active' => Yii::t('app', 'Active'),
        ];
    }

    public function getLiveEditText()
    {
        return LiveEditWidget::widget([
            'text' => $this->text,
            'linkCreate' => ['/admin/pages/default/create', 'slug' => $this->slug],
            'linkUpdate' => ['/admin/pages/default/update', 'slug' => $this->slug]
        ]);
    }

    public function getLiveEditName()
    {
        return LiveEditWidget::widget([
            'text' => $this->name,
            'linkCreate' => ['/admin/pages/default/create', 'slug' => $this->slug],
            'linkUpdate' => ['/admin/pages/default/update', 'slug' => $this->slug]
        ]);
    }

    public function getImage($width = null, $height = null)
    {
        if(!isset(Yii::$app->params['noimage'])) return Image::thumb($this->image, $width, $height);

        $path = empty($this->image) ? Yii::$app->params['noimage'] : $this->image;

        $image = Image::thumb($path, $width, $height);

        return empty($image) ? Image::thumb(Yii::$app->params['noimage'], $width, $height) : $image;
    }

    public static function get($slug)
    {
        $model = static::findOne(['slug' => $slug]);

        return empty($model) ? Yii::createObject(['class' => static::className(), 'slug' => $slug]) : $model;
    }

}

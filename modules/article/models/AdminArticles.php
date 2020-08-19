<?php

namespace grozzzny\admin\modules\article\models;

use grozzzny\admin\components\seo\AdminSeoBehavior;
use grozzzny\admin\helpers\Image;
use grozzzny\admin\widgets\file_input\components\FileBehavior;
use grozzzny\admin\widgets\live_edit\LiveEditWidget;
use Yii;
use yii\behaviors\SluggableBehavior;
use yii\behaviors\TimestampBehavior;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "admin_articles".
 *
 * @property int $id
 * @property string|null $slug
 * @property string|null $image
 * @property string|null $name
 * @property string|null $text
 * @property int|null $active
 *
 * @property-read AdminSeo $seo
 * @property string $short
 */
class AdminArticles extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'admin_articles';
    }

    public function behaviors()
    {
        return ArrayHelper::merge(parent::behaviors(), [
            'image' => [
                'class' => FileBehavior::className(),
                'fileAttribute' => 'image',
                'uploadPath' => '/uploads/article',
            ],
            'seo' => [
                'class' => AdminSeoBehavior::className(),
                'key' => 'article',
            ],
            'slug' => [
                'class' => SluggableBehavior::className(),
                'attribute' => 'name'
            ],
            TimestampBehavior::className(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['image'], 'image'],
            [['text', 'short'], 'string'],
            [['active', 'updated_at', 'created_at'], 'integer'],
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
            'image' => Yii::t('app', 'Image'),
            'name' => Yii::t('app', 'Name'),
            'text' => Yii::t('app', 'Text'),
            'short' => Yii::t('app', 'Short text'),
            'active' => Yii::t('app', 'Active'),
        ];
    }

    public function getLiveEditH1()
    {
        return LiveEditWidget::widget([
            'text' => $this->seo->get('h1', $this->name),
            'linkCreate' => ['/admin/article/default/create', 'slug' => $this->slug],
            'linkUpdate' => ['/admin/article/default/update', 'slug' => $this->slug]
        ]);
    }

    public function getLiveEditText()
    {
        return LiveEditWidget::widget([
            'text' => $this->text,
            'linkCreate' => ['/admin/article/default/create', 'slug' => $this->slug],
            'linkUpdate' => ['/admin/article/default/update', 'slug' => $this->slug]
        ]);
    }

    public function getLiveEditName()
    {
        return LiveEditWidget::widget([
            'text' => $this->name,
            'linkCreate' => ['/admin/article/default/create', 'slug' => $this->slug],
            'linkUpdate' => ['/admin/article/default/update', 'slug' => $this->slug]
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

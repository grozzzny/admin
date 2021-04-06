<?php

namespace grozzzny\admin\modules\images\models;

use grozzzny\admin\helpers\Image;
use grozzzny\admin\widgets\file_input\components\FileBehavior;
use Yii;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "admin_image_files".
 *
 * @property int $id
 * @property string|null $slug
 * @property string|null $name
 * @property string|null $file
 * @property int|null $active
 */
class AdminImageFiles extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'admin_image_files';
    }

    public function behaviors()
    {
        return ArrayHelper::merge(parent::behaviors(), [
            'file' => [
                'class' => FileBehavior::className(),
                'fileAttribute' => 'file',
                'uploadPath' => '/uploads/image_files',
            ],
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['active'], 'integer'],
            [['file'], 'image'],
            [['slug', 'name'], 'string', 'max' => 255],
            [['slug'], 'match', 'pattern' => '/[A-z\-_]+/'],
            [['slug'], 'required'],
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
            'file' => Yii::t('app', 'Image file'),
            'active' => Yii::t('app', 'Active'),
        ];
    }

    public function getImage($width = null, $height = null)
    {
        if(!isset(Yii::$app->params['noimage'])) return Image::thumb($this->file, $width, $height);

        $path = empty($this->file) ? Yii::$app->params['noimage'] : $this->file;

        $image = Image::thumb($path, $width, $height);

        return empty($image) ? Image::thumb(Yii::$app->params['noimage'], $width, $height) : $image;
    }

    public static function get($slug, $width = null, $height = null)
    {
        $model = static::findOne(['slug' => $slug]);

        if(empty($model)) return isset(Yii::$app->params['noimage']) ? Yii::$app->params['noimage'] : null;

        return $model->getImage($width, $height);
    }
}

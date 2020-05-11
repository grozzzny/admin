<?php

namespace grozzzny\admin\modules\text\models;

use Yii;

/**
 * This is the model class for table "admin_text".
 *
 * @property int $id
 * @property string|null $slug
 * @property string|null $text
 *
 * CRUD Generator
 * This generator generates a controller and views that implement CRUD (Create, Read, Update, Delete) operations for the specified data model.
 *
 * Model Class
 * grozzzny\admin\modules\text\models\AdminText
 * Search Model Class
 * grozzzny\admin\modules\text\models\AdminTextSearch
 * Controller Class
 * grozzzny\admin\modules\text\controllers\DefaultController
 * View Path
 * @grozzzny\admin\modules\text\views\default
 * Base Controller Class
 * yii\web\Controller
 * Widget Used in Index Page
 * Enable I18N
 * Enable Pjax
 * Message Category
 * app
 * Code Template
 * default (C:\OSPanel\domains\case\www\vendor\yiisoft\yii2-gii\src\generators\crud/default)
 */
class AdminText extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'admin_text';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['slug'], 'required'],
            [['slug'], 'match', 'pattern' => '/[A-z\-_]+/'],
            [['slug', 'text'], 'string', 'max' => 255],
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
            'text' => Yii::t('app', 'Text'),
        ];
    }
}

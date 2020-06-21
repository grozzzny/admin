<?php

namespace grozzzny\admin\components\images;

use Yii;

/**
 * This is the model class for table "admin_images".
 *
 * @property int $id
 * @property string|null $key
 * @property int|null $item_id
 * @property string|null $author
 * @property string|null $description
 * @property string|null $file
 */
class AdminImages extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'admin_images';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['item_id'], 'integer'],
            [['key', 'author', 'description'], 'string', 'max' => 255],
//            [['key', 'item_id'], 'unique', 'targetAttribute' => ['key', 'item_id']],
            ['file', 'image'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'key' => Yii::t('app', 'Key'),
            'item_id' => Yii::t('app', 'Item ID'),
            'author' => Yii::t('app', 'Author'),
            'description' => Yii::t('app', 'Description'),
            'file' => Yii::t('app', 'File'),
        ];
    }

    /**
     * Formats all model errors into a single string
     * @return string
     */
    public function formatErrors()
    {
        $result = '';
        foreach($this->getErrors() as $attribute => $errors) {
            $result .= implode(" ", $errors)." ";
        }
        return $result;
    }
}

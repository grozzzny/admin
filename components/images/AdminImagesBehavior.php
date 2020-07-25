<?php


namespace grozzzny\admin\components\images;


use Yii;
use yii\base\Behavior;
use yii\db\ActiveRecord;

/**
 * Class AdminSeoBehavior
 * @package grozzzny\admin\components\images
 *
 */
class AdminImagesBehavior extends Behavior
{
    /**
     * @var ActiveRecord
     */
    public $owner;
    public $key = 'events';

    public function events()
    {
        return [
            ActiveRecord::EVENT_AFTER_DELETE => 'delete',
        ];
    }

    public function delete()
    {
        foreach($this->getImages()->all() as $image){
            $image->delete();
        }
    }

    public function getImages()
    {
        /** @var AdminImages $model */
        $model = Yii::$container->get(AdminImages::class);

        return $this->owner->hasMany($model::className(), ['item_id' => 'id'])->where(['key' => $this->key]);
    }
}
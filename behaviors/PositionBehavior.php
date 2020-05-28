<?php


namespace grozzzny\admin\behaviors;


use yii\base\Behavior;
use yii\db\ActiveRecord;

class PositionBehavior extends Behavior
{
    /**
     * @var ActiveRecord
     */
    public $owner;

    public $attribute;

    public function events()
    {
        return [
            ActiveRecord::EVENT_AFTER_INSERT => 'insert',
            ActiveRecord::EVENT_AFTER_UPDATE => 'update',
        ];
    }

    public function insert()
    {
        /** @var ActiveRecord $model */
        $model = $this->owner;
        $attribute = $this->attribute;

        if(!empty($model->$attribute)) {
            $this->setPosition($model->$attribute);
        } else {
            $this->setLastPosition();
        }
    }

    public function setLastPosition()
    {
        /** @var ActiveRecord $model */
        $model = $this->owner;
        $attribute = $this->attribute;

        $count = $model::find()->count();

        $model->$attribute = $count;

        $key = $model::primaryKey()[0];

        $model::updateAll([$attribute => $count], [$key => $model->primaryKey]);
    }

    public function update()
    {
        /** @var ActiveRecord $model */
        $model = $this->owner;
        $attribute = $this->attribute;
        $position = $model->$attribute;

        $this->setPosition($position);
    }

    public function setPosition($position)
    {
        /** @var ActiveRecord $model */
        $model = $this->owner;
        $attribute = $this->attribute;

        $key = $model::primaryKey()[0];

        $allModels = $model::find()
            ->orderBy([$attribute => SORT_ASC])
            ->andWhere(['!=', $key, $model->primaryKey])
            ->all();

        array_splice( $allModels, (integer) $position - 1, 0, [$model]);

        foreach ($allModels as $i => $item){
            $item::updateAll([$attribute => $i + 1], [$key => $item->primaryKey]);
        }
    }
}
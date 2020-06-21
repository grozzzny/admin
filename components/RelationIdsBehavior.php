<?php


namespace grozzzny\admin\components;


use Yii;
use yii\base\Behavior;
use yii\db\ActiveRecord;
use yii\helpers\ArrayHelper;

class RelationIdsBehavior extends Behavior
{
    /**
     * @var ActiveRecord
     */
    public $owner;

    public $relationName;

    public $attribute;

    public function events()
    {
        return [
            ActiveRecord::EVENT_AFTER_INSERT => 'afterUpdate',
            ActiveRecord::EVENT_AFTER_UPDATE => 'afterUpdate',
            ActiveRecord::EVENT_AFTER_FIND => 'afterFind',
        ];
    }

    public function afterUpdate()
    {
        $model = $this->owner;
        $attribute = $this->attribute;
        $ids = $model->{$attribute};
        $relation = $model->getRelation($this->relationName);
        /** @var ActiveRecord $relationModelClass */
        $relationModelClass = $relation->modelClass;

        $model->unlinkAll($this->relationName, true);

        foreach ($ids as $id){

            $relationModel = $relationModelClass::findOne($id);

            if(empty($relationModel)) continue;

            $model->link($this->relationName, $relationModel);
        }
    }

    public function afterFind()
    {
        $model = $this->owner;
        $relationName = $this->relationName;
        $models = $model->{$relationName};

        $relation = $model->getRelation($this->relationName);
        /** @var ActiveRecord $relationModelClass */
        $relationModelClass = $relation->modelClass;

        $model->{$this->attribute} = ArrayHelper::getColumn($models, $relationModelClass::primaryKey()[0]);
    }
}
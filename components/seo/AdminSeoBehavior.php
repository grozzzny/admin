<?php


namespace grozzzny\admin\components\seo;


use Yii;
use yii\base\Behavior;
use yii\base\Exception;
use yii\db\ActiveRecord;

/**
 * Class AdminSeoBehavior
 * @package grozzzny\admin\components\seo
 *
 * @property-read AdminSeo $seo
 */
class AdminSeoBehavior extends Behavior
{
    public $key;

    private $_model;

    /**
     * @var ActiveRecord
     */
    public $owner;

    public function events()
    {
        return [
            ActiveRecord::EVENT_AFTER_INSERT => 'update',
            ActiveRecord::EVENT_AFTER_UPDATE => 'update',
            ActiveRecord::EVENT_AFTER_DELETE => 'delete',
        ];
    }

    public function update()
    {
        if(!isset(Yii::$app->request) && !Yii::$app->request->isPost) return false;

        if(!$this->seo->load(Yii::$app->request->post())) return false;

        if($this->seo->save()){
            return true;
        } else {
            throw new Exception(Yii::t('app', 'Error save: {0}', json_encode($this->seo->errors, JSON_UNESCAPED_UNICODE)));
        }
    }

    public function delete()
    {
        if($this->seo->isNewRecord) return false;

        return $this->seo->delete();
    }

    public function getSeo()
    {
        if(!empty($this->_model)) return $this->_model;

        return $this->_model = $this->useModel($this->key, $this->owner->primaryKey);
    }

    protected function useModel($key, $item_id)
    {
        /** @var AdminSeo $instance */
        $instance = Yii::$container->get(AdminSeo::class);

        $model = $instance::find()->where([
            'key' => $key,
            'item_id' => $item_id
        ])->one();

        return empty($model) ? Yii::createObject([
            'class' => $instance::className(),
            'key' => $key,
            'item_id' => $item_id,
        ]) : $model;
    }
}
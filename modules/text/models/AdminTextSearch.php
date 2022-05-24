<?php

namespace grozzzny\admin\modules\text\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use grozzzny\admin\modules\text\models\AdminText;

/**
 * AdminTextSearch represents the model behind the search form of `grozzzny\admin\modules\text\models\AdminText`.
 */
class AdminTextSearch extends AdminText
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id'], 'integer'],
            [['slug', 'text'], 'safe'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search($params)
    {
        /** @var AdminText $instance */
        $instance = Yii::$container->get(AdminText::class);

        $query = $instance::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
        ]);

        $query->andFilterWhere(['like', 'slug', $this->slug])
            ->andFilterWhere(['like', 'text', $this->text]);

        return $dataProvider;
    }
}

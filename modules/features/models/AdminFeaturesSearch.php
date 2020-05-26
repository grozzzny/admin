<?php

namespace grozzzny\admin\modules\features\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use grozzzny\admin\modules\features\models\AdminFeatures;

/**
 * AdminFeaturesSearch represents the model behind the search form of `grozzzny\admin\modules\features\models\AdminFeatures`.
 */
class AdminFeaturesSearch extends AdminFeatures
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'position', 'active'], 'integer'],
            [['icon', 'image', 'title', 'description', 'link'], 'safe'],
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
        $query = AdminFeatures::find();

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
            'position' => $this->position,
            'active' => $this->active,
        ]);

        $query->andFilterWhere(['like', 'icon', $this->icon])
            ->andFilterWhere(['like', 'image', $this->image])
            ->andFilterWhere(['like', 'title', $this->title])
            ->andFilterWhere(['like', 'description', $this->description])
            ->andFilterWhere(['like', 'link', $this->link]);

        return $dataProvider;
    }
}

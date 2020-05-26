<?php

namespace grozzzny\admin\modules\feedback\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use grozzzny\admin\modules\feedback\models\AdminFeedback;

/**
 * AdminFeedbackSearch represents the model behind the search form of `grozzzny\admin\modules\feedback\models\AdminFeedback`.
 */
class AdminFeedbackSearch extends AdminFeedback
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'active', 'created_at', 'updated_at', 'created_by', 'updated_by'], 'integer'],
            [['name', 'email', 'phone', 'message'], 'safe'],
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
        $query = AdminFeedback::find();

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
            'active' => $this->active,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
            'created_by' => $this->created_by,
            'updated_by' => $this->updated_by,
        ]);

        $query->andFilterWhere(['like', 'name', $this->name])
            ->andFilterWhere(['like', 'email', $this->email])
            ->andFilterWhere(['like', 'phone', $this->phone])
            ->andFilterWhere(['like', 'message', $this->message]);

        return $dataProvider;
    }
}

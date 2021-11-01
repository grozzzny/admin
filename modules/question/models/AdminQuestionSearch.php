<?php

namespace grozzzny\admin\modules\question\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use grozzzny\admin\modules\question\models\AdminQuestion;

/**
 * AdminQuestionSearch represents the model behind the search form of `grozzzny\admin\modules\question\models\AdminQuestion`.
 */
class AdminQuestionSearch extends AdminQuestion
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'active', 'created_at', 'updated_at', 'created_by', 'updated_by'], 'integer'],
            [['question', 'answer'], 'safe'],
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
        $query = AdminQuestion::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'sort' => [
                'defaultOrder' => [
                    'created_at' => SORT_DESC
                ]
            ]
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

        $query->andFilterWhere(['like', 'question', $this->question])
            ->andFilterWhere(['like', 'answer', $this->answer]);

        return $dataProvider;
    }
}

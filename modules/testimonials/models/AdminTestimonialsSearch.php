<?php

namespace grozzzny\admin\modules\testimonials\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use grozzzny\admin\modules\testimonials\models\AdminTestimonials;

/**
 * AdminTestimonialsSearch represents the model behind the search form of `grozzzny\admin\modules\testimonials\models\AdminTestimonials`.
 */
class AdminTestimonialsSearch extends AdminTestimonials
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'position', 'active', 'created_at', 'updated_at', 'created_by', 'updated_by'], 'integer'],
            [['image', 'name', 'description'], 'safe'],
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
        $query = AdminTestimonials::find();

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
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
            'created_by' => $this->created_by,
            'updated_by' => $this->updated_by,
        ]);

        $query->andFilterWhere(['like', 'image', $this->image])
            ->andFilterWhere(['like', 'name', $this->name])
            ->andFilterWhere(['like', 'description', $this->description]);

        return $dataProvider;
    }
}

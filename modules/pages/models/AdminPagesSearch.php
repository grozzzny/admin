<?php

namespace grozzzny\admin\modules\pages\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use grozzzny\admin\modules\pages\models\AdminPages;

/**
 * AdminPagesSearch represents the model behind the search form of `grozzzny\admin\modules\pages\models\AdminPages`.
 */
class AdminPagesSearch extends AdminPages
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'active'], 'integer'],
            [['slug', 'image', 'name', 'text'], 'safe'],
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
        /** @var AdminPages $instance */
        $instance = Yii::$container->get(AdminPages::class);

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
            'active' => $this->active,
        ]);

        $query->andFilterWhere(['like', 'slug', $this->slug])
            ->andFilterWhere(['like', 'image', $this->image])
            ->andFilterWhere(['like', 'name', $this->name])
            ->andFilterWhere(['like', 'text', $this->text]);

        return $dataProvider;
    }
}

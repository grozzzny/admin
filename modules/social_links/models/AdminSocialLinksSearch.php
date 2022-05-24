<?php

namespace grozzzny\admin\modules\social_links\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use grozzzny\admin\modules\social_links\models\AdminSocialLinks;

/**
 * AdminSocialLinksSearch represents the model behind the search form of `grozzzny\admin\modules\social_links\models\AdminSocialLinks`.
 */
class AdminSocialLinksSearch extends AdminSocialLinks
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'position', 'active'], 'integer'],
            [['title', 'link', 'icon'], 'safe'],
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
        /** @var AdminSocialLinks $instance */
        $instance = Yii::$container->get(AdminSocialLinks::class);

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
            'position' => $this->position,
            'active' => $this->active,
        ]);

        $query->andFilterWhere(['like', 'title', $this->title])
            ->andFilterWhere(['like', 'link', $this->link])
            ->andFilterWhere(['like', 'icon', $this->icon]);

        return $dataProvider;
    }
}

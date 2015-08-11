<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Rating;

/**
 * RatingSearch represents the model behind the search form about `app\models\Rating`.
 */
class RatingSearch extends Rating
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['user_id', 'recipe_id', 'level'], 'integer'],
            [['created', 'updated'], 'safe'],
        ];
    }

    /**
     * @inheritdoc
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
        $query = Rating::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        $query->andFilterWhere([
            'user_id' => $this->user_id,
            'recipe_id' => $this->recipe_id,
            'level' => $this->level,
            'created' => $this->created,
            'updated' => $this->updated,
        ]);

        return $dataProvider;
    }
}

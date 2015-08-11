<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Recipe;

/**
 * RecipeSearch represents the model behind the search form about `app\models\Recipe`.
 */
class RecipeSearch extends Recipe
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'difficulty', 'duration', 'prepare_time', 'category_id', 'serving_size'], 'integer'],
            [['name', 'description', 'created', 'updated'], 'safe'],
            [['budget'], 'number'],
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
        $query = Recipe::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'pagination' => [
                'pageSize' => 10,
            ],
            'sort' => [
                'defaultOrder'=>['created'=>'desc']
            ]
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        $query->andFilterWhere([
            'id' => $this->id,
            'difficulty' => $this->difficulty,
            'duration' => $this->duration,
            'budget' => $this->budget,
            'prepare_time' => $this->prepare_time,
            'category_id' => $this->category_id,
            'serving_size' => $this->serving_size,
        ]);

        $query->andFilterWhere(['like', 'name', $this->name])
            ->andFilterWhere(['like', 'created', $this->created])
            ->andFilterWhere(['like', 'updated', $this->updated]);

        return $dataProvider;
    }
}

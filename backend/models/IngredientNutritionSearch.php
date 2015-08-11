<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\IngredientNutrition;

/**
 * IngredientNutritionSearch represents the model behind the search form about `app\models\IngredientNutrition`.
 */
class IngredientNutritionSearch extends IngredientNutrition
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['ingre_id', 'nutri_id'], 'integer'],
            [['quantity'], 'number'],
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
        $query = IngredientNutrition::find();

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
            'ingre_id' => $this->ingre_id,
            'nutri_id' => $this->nutri_id,
            'quantity' => $this->quantity,
        ]);

        return $dataProvider;
    }
}

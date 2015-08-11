<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\RecipeIngredient;

/**
 * RecipeIngredientSearch represents the model behind the search form about `app\models\RecipeIngredient`.
 */
class RecipeIngredientSearch extends RecipeIngredient
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['recipe_id', 'ingre_id', 'measure_unit_id'], 'integer'],
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
        $query = RecipeIngredient::find();

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
            'recipe_id' => $this->recipe_id,
            'ingre_id' => $this->ingre_id,
            'measure_unit_id' => $this->measure_unit_id,
            'quantity' => $this->quantity,
        ]);

        return $dataProvider;
    }
}

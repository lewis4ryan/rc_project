<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\IngredientUnit;

/**
 * IngredientUnitSearch represents the model behind the search form about `app\models\IngredientUnit`.
 */
class IngredientUnitSearch extends IngredientUnit
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['ingre_id', 'measureunit_id'], 'integer'],
            [['weight'], 'number'],
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
        $query = IngredientUnit::find();

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
            'measureunit_id' => $this->measureunit_id,
            'weight' => $this->weight,
        ]);

        return $dataProvider;
    }
}

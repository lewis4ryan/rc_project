<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Nutrition;

/**
 * NutritionSearch represents the model behind the search form about `app\models\Nutrition`.
 */
class NutritionSearch extends Nutrition
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'unit_id'], 'integer'],
            [['name', 'daily_value', 'created', 'updated'], 'safe'],
            [['daily_value'], 'number'],
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
        $query = Nutrition::find();

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
            'unit_id' => $this->unit_id,
        ]);

        $query->andFilterWhere(['like', 'name', $this->name]);
        $query->andFilterWhere(['like', 'daily_value', $this->daily_value]);
        $query->andFilterWhere(['like', 'created', $this->created]);
        $query->andFilterWhere(['like', 'updated', $this->updated]);

        return $dataProvider;
    }
}

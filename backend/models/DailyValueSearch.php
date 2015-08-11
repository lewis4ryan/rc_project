<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\DailyValue;

/**
 * DailyValueSearch represents the model behind the search form about `app\models\DailyValue`.
 */
class DailyValueSearch extends DailyValue
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'measure_unit'], 'safe'],
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
        $query = DailyValue::find();

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
            'daily_value' => $this->daily_value,
        ]);

        $query->andFilterWhere(['like', 'id', $this->id])
            ->andFilterWhere(['like', 'measure_unit', $this->measure_unit]);

        return $dataProvider;
    }
}

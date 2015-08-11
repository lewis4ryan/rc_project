<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Shopping;

/**
 * ShoppingSearch represents the model behind the search form about `app\models\Shopping`.
 */
class ShoppingSearch extends Shopping
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['user_id', 'ingre_id', 'measure_unit_id'], 'integer'],
            [['quantity'], 'number'],
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
        $query = Shopping::find();

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
            'ingre_id' => $this->ingre_id,
            'measure_unit_id' => $this->measure_unit_id,
            'quantity' => $this->quantity,
            'created' => $this->created,
            'updated' => $this->updated,
        ]);

        return $dataProvider;
    }
}

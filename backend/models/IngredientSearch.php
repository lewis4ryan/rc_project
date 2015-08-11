<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
//use app\models\Ingredient;
//use yii\data\Pagination;


/**
 * IngredientSearch represents the model behind the search form about `app\models\Ingredient`.
 */
class IngredientSearch extends Ingredient
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'ingre_group_id', 'is_vegetarian'], 'integer'],
            [['name', 'picture', 'is_vegetarian', 'created', 'updated'], 'safe'],
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
        $query = Ingredient::find();

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
            'ingre_group_id' => $this->ingre_group_id,
            'is_vegetarian' => $this->is_vegetarian,
        ]);

        $query->andFilterWhere(['like', 'name', $this->name])
            //->andFilterWhere(['like', 'description', $this->description])
            ->andFilterWhere(['like', 'created', $this->created])
            ->andFilterWhere(['like', 'updated', $this->updated]);

        return $dataProvider;
    }
}

<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "recipe_ingredient".
 *
 * @property integer $recipe_id
 * @property integer $ingre_id
 * @property integer $measure_unit_id
 * @property double $quantity
 *
 * @property IngredientUnit $ingre
 * @property Recipe $recipe
 */
class RecipeIngredient extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'recipe_ingredient';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['recipe_id', 'ingre_id', 'measure_unit_id', 'quantity'], 'required'],
            [['recipe_id', 'ingre_id', 'measure_unit_id'], 'integer'],
            [['quantity'], 'number']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'recipe_id' => 'Recipe ID',
            'ingre_id' => 'Ingre ID',
            'measure_unit_id' => 'Measure Unit ID',
            'quantity' => 'Quantity',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIngre()
    {
        return $this->hasOne(IngredientUnit::className(), ['ingre_id' => 'ingre_id', 'measureunit_id' => 'measure_unit_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRecipe()
    {
        return $this->hasOne(Recipe::className(), ['id' => 'recipe_id']);
    }
}

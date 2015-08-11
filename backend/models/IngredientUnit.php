<?php

namespace app\models;

use Yii;
/**
 * This is the model class for table "ingredient_unit".
 *
 * @property integer $ingre_id
 * @property integer $measureunit_id
 * @property double $weight
 *
 * @property Ingredient $ingre
 * @property Measureunit $measureunit
 * @property RecipeIngredient[] $recipeIngredients
 * @property Shopping[] $shoppings
 */
class IngredientUnit extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'ingredient_unit';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['ingre_id', 'measureunit_id', 'weight'], 'required'],
            [['ingre_id', 'measureunit_id'], 'unique', 'targetAttribute' => ['ingre_id','measureunit_id']],
            [['ingre_id', 'measureunit_id'], 'integer'],
            [['weight'], 'number']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'ingre_id' => 'Nguyên liệu',
            'measureunit_id' => 'Đơn vị',
            'weight' => 'Trọng lượng',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIngre()
    {
        return $this->hasOne(Ingredient::className(), ['id' => 'ingre_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMeasureunit()
    {
        return $this->hasOne(Measureunit::className(), ['id' => 'measureunit_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRecipeIngredients()
    {
        return $this->hasMany(RecipeIngredient::className(), ['ingre_id' => 'ingre_id', 'measure_unit_id' => 'measureunit_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getShoppings()
    {
        return $this->hasMany(Shopping::className(), ['ingre_id' => 'ingre_id', 'measure_unit_id' => 'measureunit_id']);
    }
}

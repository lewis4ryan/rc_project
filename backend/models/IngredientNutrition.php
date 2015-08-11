<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "ingredient_nutrition".
 *
 * @property integer $ingre_id
 * @property integer $nutri_id
 * @property double $quantity
 *
 * @property Ingredient $ingre
 * @property Nutrition $nutri
 */
class IngredientNutrition extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'ingredient_nutrition';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['ingre_id', 'nutri_id', 'quantity'], 'required'],
            [['ingre_id', 'nutri_id'], 'integer'],
            [['quantity'], 'number']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'ingre_id' => 'Ingre ID',
            'nutri_id' => 'Nutri ID',
            'quantity' => 'Quantity',
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
    public function getNutri()
    {
        return $this->hasOne(Nutrition::className(), ['id' => 'nutri_id']);
    }
}

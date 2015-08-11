<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "step".
 *
 * @property integer $id
 * @property integer $step_number
 * @property string $content
 * @property integer $recipe_id
 *
 * @property Recipe $recipe
 */
class Step extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'step';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['step_number', 'content', 'recipe_id'], 'required'],
            [['step_number', 'recipe_id'], 'integer'],
            [['content'], 'string']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'step_number' => 'Step Number',
            'content' => 'Content',
            'recipe_id' => 'Recipe ID',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRecipe()
    {
        return $this->hasOne(Recipe::className(), ['id' => 'recipe_id']);
    }
}

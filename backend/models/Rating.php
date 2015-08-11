<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "rating".
 *
 * @property integer $user_id
 * @property integer $recipe_id
 * @property integer $level
 * @property string $created
 * @property string $updated
 *
 * @property Recipe $recipe
 * @property User $user
 */
class Rating extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'rating';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['user_id', 'recipe_id', 'level'], 'required'],
            [['user_id', 'recipe_id', 'level'], 'integer'],
            [['created', 'updated'], 'safe']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'user_id' => 'User ID',
            'recipe_id' => 'Recipe ID',
            'level' => 'Level',
            'created' => 'Created',
            'updated' => 'Updated',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRecipe()
    {
        return $this->hasOne(Recipe::className(), ['id' => 'recipe_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'user_id']);
    }
}

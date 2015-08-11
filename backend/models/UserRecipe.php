<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "user_recipe".
 *
 * @property integer $recipe_id
 * @property integer $user_id
 * @property string $created
 * @property string $updated
 *
 * @property Recipe $recipe
 * @property User $user
 */
class UserRecipe extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'user_recipe';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['recipe_id', 'user_id'], 'required'],
            [['recipe_id', 'user_id'], 'integer'],
            [['created', 'updated'], 'safe']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'recipe_id' => 'Recipe ID',
            'user_id' => 'User ID',
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

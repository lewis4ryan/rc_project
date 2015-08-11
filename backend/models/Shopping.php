<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "shopping".
 *
 * @property integer $user_id
 * @property integer $ingre_id
 * @property integer $measure_unit_id
 * @property double $quantity
 * @property string $created
 * @property string $updated
 *
 * @property IngredientUnit $ingre
 * @property User $user
 */
class Shopping extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'shopping';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['user_id', 'ingre_id', 'measure_unit_id', 'quantity'], 'required'],
            [['user_id', 'ingre_id', 'measure_unit_id'], 'integer'],
            [['quantity'], 'number'],
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
            'ingre_id' => 'Ingre ID',
            'measure_unit_id' => 'Measure Unit ID',
            'quantity' => 'Quantity',
            'created' => 'Created',
            'updated' => 'Updated',
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
    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'user_id']);
    }
}

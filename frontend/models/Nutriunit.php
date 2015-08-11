<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "nutriunit".
 *
 * @property integer $id
 * @property string $name
 * @property string $comment
 *
 * @property Nutrition[] $nutritions
 */
class Nutriunit extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'nutriunit';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name'], 'required'],
            [['name', 'comment'], 'string', 'max' => 50]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
            'comment' => 'Comment',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getNutritions()
    {
        return $this->hasMany(Nutrition::className(), ['unit_id' => 'id']);
    }
}

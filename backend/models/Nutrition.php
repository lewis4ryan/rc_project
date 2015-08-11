<?php

namespace app\models;

use Yii;
use yii\db\Expression;
use yii\behaviors\TimestampBehavior;

/**
 * This is the model class for table "nutrition".
 *
 * @property integer $id
 * @property string $name
 * @property integer $unit_id
 * @property double $daily_value
 *
 * @property IngredientNutrition[] $ingredientNutritions
 * @property Ingredient[] $ingres
 * @property Nutriunit $unit
 */
class Nutrition extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'nutrition';
    }

    public function behaviors()
    {
        return [
            [
                'class' => TimestampBehavior::className(),
                'createdAtAttribute' => 'created',
                'updatedAtAttribute' => 'updated',
                'value' => new Expression('NOW()'),
            ],
        ];
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'unit_id'], 'required'],
            [['unit_id'], 'integer'],
            [['info'], 'string'],
            [['daily_value'], 'number'],
            [['name'], 'string', 'max' => 50],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'Mã',
            'name' => 'Tên',
            'unit_id' => 'Đơn vị',
            'daily_value' => 'Dinh dưỡng hằng ngày',
            'info' => 'Chi tiết',
            'created' => 'Ngày tạo',
            'updated' => 'Ngày sửa',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIngredientNutritions()
    {
        return $this->hasMany(IngredientNutrition::className(), ['nutri_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIngres()
    {
        return $this->hasMany(Ingredient::className(), ['id' => 'ingre_id'])->viaTable('ingredient_nutrition', ['nutri_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUnit()
    {
        return $this->hasOne(Nutriunit::className(), ['id' => 'unit_id']);
    }

    public function beforeSave($insert){
        $this->name = ucfirst($this->name);
        return parent::beforeSave($insert);
    }

    public function afterFind(){
        if(Yii::$app->controller->id == 'nutrition' && Yii::$app->controller->action->id == 'index' ){
            if($this->created != null){
                $this->created = date ('d.m.Y H:i', strtotime ($this->created));
            }
            if($this->updated != null){
                $this->updated = date ('d.m.Y H:i', strtotime ($this->updated));
            }
        }
        return parent::afterFind();
    }

    public function afterValidate(){
        if(Yii::$app->controller->id == 'nutrition' && Yii::$app->controller->action->id == 'index' ){
            if($this->updated!= null)
                $this->updated=date('Y-m-d', strtotime($this->updated));
            if($this->created!= null)
                $this->created=date('Y-m-d', strtotime($this->created));
        }
        return parent::afterValidate();
    }

    public function beforeValidate(){
        if(Yii::$app->controller->id == 'nutrition' && Yii::$app->controller->action->id == 'index' ){
            if($this->updated!= null)
                $this->updated=date('Y-m-d', strtotime($this->updated));
            if($this->created!= null)
                $this->created=date('Y-m-d', strtotime($this->created));
        }

        return parent::beforeValidate();
    }
}

<?php

namespace app\models;

use Yii;
use yii\db\Expression;
use yii\behaviors\TimestampBehavior;

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
            [['name'], 'required'],
            [['name'], 'unique','message'=>'Đơn vị này đã tồn tại!'],
            [['name', 'comment'], 'string', 'max' => 50]
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
            'comment' => 'Ghi chú',
            'created' => 'Ngày tạo',
            'updated' => 'Ngày sửa',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getNutritions()
    {
        return $this->hasMany(Nutrition::className(), ['unit_id' => 'id']);
    }



    public static function dropdown() {
        $models = static::find()->orderBy('name ASC')->all();
        $dropdown =array();
        if($models){
            foreach ($models as $model) {
                $dropdown[$model->id] = $model->name;
            }
        }
        return $dropdown;
    }

    public function afterSave(){
        //self::findOne(1)->id;
    }

    public function afterFind(){
        if(Yii::$app->controller->id == 'nutriunit' && Yii::$app->controller->action->id == 'index' ){
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
        if(Yii::$app->controller->id == 'nutriunit' && Yii::$app->controller->action->id == 'index' ){
            if($this->updated!= null)
                $this->updated=date('Y-m-d', strtotime($this->updated));
            if($this->created!= null)
                $this->created=date('Y-m-d', strtotime($this->created));
        }
        return parent::afterValidate();
    }

    public function beforeValidate(){
        if(Yii::$app->controller->id == 'nutriunit' && Yii::$app->controller->action->id == 'index' ){
            if($this->updated!= null)
                $this->updated=date('Y-m-d', strtotime($this->updated));
            if($this->created!= null)
                $this->created=date('Y-m-d', strtotime($this->created));
        }

        return parent::beforeValidate();
    }
}

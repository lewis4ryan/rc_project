<?php

namespace app\models;

use Yii;
use yii\db\Expression;
use yii\behaviors\TimestampBehavior;
/**
 * This is the model class for table "measureunit".
 *
 * @property integer $id
 * @property string $name
 * @property string $comment
 *
 * @property IngredientUnit[] $ingredientUnits
 * @property Ingredient[] $ingres
 */
class Measureunit extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'measureunit';
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
            [['name'], 'string', 'max' => 50],
            [['comment'], 'string', 'max' => 255],
            [['name'], 'unique'],
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
    public function getIngredientUnits()
    {
        return $this->hasMany(IngredientUnit::className(), ['measureunit_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIngres()
    {
        return $this->hasMany(Ingredient::className(), ['id' => 'ingre_id'])->viaTable('ingredient_unit', ['measureunit_id' => 'id']);
    }

    public function beforeSave($insert){
        return parent::beforeSave($insert);
    }

    public function afterFind(){
        if(Yii::$app->controller->id == 'measureunit' && (Yii::$app->controller->action->id == 'index' || Yii::$app->controller->action->id == 'view') ){
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
        if(Yii::$app->controller->id == 'measureunit' && Yii::$app->controller->action->id == 'index' ){
            if($this->updated!= null)
                $this->updated=date('Y-m-d', strtotime($this->updated));
            if($this->created!= null)
                $this->created=date('Y-m-d', strtotime($this->created));
        }
        return parent::afterValidate();
    }

    public function beforeValidate(){
        if(Yii::$app->controller->id == 'measureunit' && Yii::$app->controller->action->id == 'index' ){
            if($this->updated!= null)
                $this->updated=date('Y-m-d', strtotime($this->updated));
            if($this->created!= null)
                $this->created=date('Y-m-d', strtotime($this->created));
        }
        return parent::beforeValidate();
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

    public static function dropdown_json() {
        $models = static::find()->orderBy('name ASC')->all();
        $data=array();
        foreach ($models as $model) {
            $child=array('value'=>$model->id,'label'=>$model->name);
            array_push($data,($child));
        }
        return ($data);
        header('Content-type: application/json');
        echo json_encode($data);
        return;
    }
}

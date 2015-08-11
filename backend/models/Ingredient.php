<?php

namespace app\models;

use Yii;
use yii\db\Expression;
use yii\behaviors\TimestampBehavior;

/**
 * This is the model class for table "ingredient".
 *
 * @property integer $id
 * @property string $name
 * @property string $picture
 * @property string $description
 * @property integer $ingre_group_id
 *
 * @property Group $ingreGroup
 * @property IngredientNutrition[] $ingredientNutritions
 * @property Nutrition[] $nutris
 * @property IngredientUnit[] $ingredientUnits
 * @property Measureunit[] $measureunits
 */
class Ingredient extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'ingredient';
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
            [['name', 'ingre_group_id', 'type', 'picture', 'is_vegetarian'], 'required'],
            [['name'], 'unique'],
            [['description'], 'string'],
            [['ingre_group_id'], 'integer'],
            [['name'], 'string', 'max' => 50],
            [['picture'], 'string', 'max' => 255],
            [['picture'], 'safe'],
            [['picture'], 'file', 'extensions'=>'jpg, gif, png'],
            [['calories', 'carbohydrates', 'cholesterol', 'saturated_fat', 'trans_fat', 'protein', 'dietary_fiber', 'sodium'
                , 'calcium', 'iron', 'vitamin_A', 'vitamin_C', 'vitamin_D', 'sugar', 'water', 'caffeine', 'zinc', 'thiamin', 'starch',
                'from_carb', 'from_fat', 'from_protein', 'from_alcohol', 'fat', 'trans_monoenoic', 'trans_polyenoic', 'monounsaturated',
                'polyunsaturated', 'omega_3', 'omega_6', 'magnesium', 'alcohol', 'phosphorus'
            ], 'number'],
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
            'status' => 'Trạng thái nguyên liệu',
            'picture' => 'Hình ảnh',
            'description' => 'Mô tả',
            'ingre_group_id' => 'Nhóm',
            'created' => 'Ngày tạo',
            'updated' => 'Ngày sửa',
            'type' => 'Loại',
            'group' => 'Nhóm',
            'is_vegetarian' => 'Dùng chay',

            'calories' => 'Tổng Calorie',
            'from_carb' => 'Từ Carbohydrate',
            'from_fat' => 'Từ Fat',
            'from_protein' => 'Từ Protein',
            'from_alcohol' => 'Từ Alcohol',

            'carbohydrates' => 'Tổng Carbohydrate',
            'dietary_fiber' => 'Chất xơ/Dietary Fiber',
            'sugar' => 'Đường/Sugar',
            'starch' => 'Tinh bột/Starch',

            'fat' => 'Chất béo/Fat',
            'saturated_fat' => 'Chất béo bão hòa/Saturated',
            'trans_fat' => 'Chất béo chuyển hóa/Trans',
            'monounsaturated' => 'Monounsaturated',
            'polyunsaturated' => 'Polyunsaturated',
            'omega_3' => 'Omega-3',
            'omega_6' => 'Omega-6',
            'trans_monoenoic' => 'Trans monoenoic',
            'trans_polyenoic' => 'Trans polyenoic',

            'protein' => 'Chất đạm/Protein',


            'sodium' => 'Natri/Sodium',
            'calcium' => 'Canxi/Calcium',
            'iron' => 'Sắt/Fe',
            'vitamin_A' => 'Vitamin A',
            'vitamin_C' => 'Vitamin C',
            'vitamin_D' => 'Vitamin D',
            'zinc' => 'Kẽm/Zinc',
            'thiamin' => 'Thiamin',
            'magnesium' => 'Magie/Magnesium',
            'phosphorus' => 'Photpho/Phosphorus',

            'water' => 'Nước/Water',
            'caffeine' => 'Cà phê/Caffeine',
            'alcohol' => 'Rượu, cồn/Alcohol',
            'cholesterol' => 'Mỡ máu/Cholesterol',

            'created' => 'Ngày tạo',
            'updated' => 'Ngày sửa',
        ];
    }



    const TYPE_FOOD_INGREDIENT = 1;
    const TYPE_NON_INGREDIENT = 0;
    const IS_VEGETARIAN = 1;
    const NOT_VEGETARIAN = 2;
    const UNKNOWN_VEGETARIAN = 0;

    const OPINION_CALORIE = 200;
    const VERY_LOW_LEVEL_PERCENT = 2;
    const LOW_LEVEL_PERCENT = 5;
    const HIGH_LEVEL_PERCENT = 20;
    const VERY_HIGH_LEVEL_PERCENT = 40;
    const CONVERT_SUGAR_TO_CALORIES = 3.5;
    const CONVERT_ALCOHOL_TO_CALORIES = 7;
    const CONVERT_CARB_TO_CALORIES = 4;
    const CONVERT_PROTEIN_TO_CALORIES = 4;
    const CONVERT_FAT_TO_CALORIES = 9;
    const LIMIT_PERCENT_SUGAR_ALCOHOL = 20;
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIngreGroup()
    {
        return $this->hasOne(Group::className(), ['id' => 'ingre_group_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIngredientNutritions()
    {
        return $this->hasMany(IngredientNutrition::className(), ['ingre_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getNutris()
    {
        return $this->hasMany(Nutrition::className(), ['id' => 'nutri_id'])->viaTable('ingredient_nutrition', ['ingre_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIngredientUnits()
    {
        return $this->hasMany(IngredientUnit::className(), ['ingre_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMeasureunits()
    {
        return $this->hasMany(Measureunit::className(), ['id' => 'measureunit_id'])->viaTable('ingredient_unit', ['ingre_id' => 'id']);
    }

    //code
    public function beforeSave($insert){
        $this->name = ucfirst($this->name);
        $this->from_fat = $this->fat * self::CONVERT_FAT_TO_CALORIES;
        $this->calories = $this->from_carb + $this->from_fat + $this->from_protein + $this->from_alcohol;
        return parent::beforeSave($insert);
    }

    public function afterFind(){
        if(Yii::$app->controller->id == 'ingredient' && (Yii::$app->controller->action->id == 'index' || Yii::$app->controller->action->id == 'view') ){
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
        if(Yii::$app->controller->id == 'ingredient' && Yii::$app->controller->action->id == 'index' ){
            if($this->updated!= null)
                $this->updated=date('Y-m-d', strtotime($this->updated));
            if($this->created!= null)
                $this->created=date('Y-m-d', strtotime($this->created));
        }
        return parent::afterValidate();
    }

    public function beforeValidate(){
        if(Yii::$app->controller->id == 'ingredient' && Yii::$app->controller->action->id == 'index' ){
            if($this->updated!= null)
                $this->updated=date('Y-m-d', strtotime($this->updated));
            if($this->created!= null)
                $this->created=date('Y-m-d', strtotime($this->created));
        }
        return parent::beforeValidate();
    }

    public function beforeDelete(){
        IngredientUnit::deleteAll(array('ingre_id' => $this->id));
        return parent::beforeDelete();
    }

    public function getimageurl()
    {
        // return your image url here
        return \Yii::$app->request->baseUrl.'/upload/ingredient/'.$this->picture;
    }

    public function getTypeList() {
        return array(self::TYPE_FOOD_INGREDIENT=>'Nguyên liệu tự nhiên', self::TYPE_NON_INGREDIENT=>'Nguyên liệu đóng gói, bao bì ...');
    }
    public function getType($type) {
        $temp = self::getTypeList();
        return $temp[$type];
    }
    public function getVegetarianList() {
        return array(self::IS_VEGETARIAN=>'Được', self::NOT_VEGETARIAN=>'Không', self::UNKNOWN_VEGETARIAN=>'Chưa xác định');
    }

    public function getVegetarian($type) {
        $temp = self::getVegetarianList();
        return $temp[$type];
    }

    public function is_high_sugar_in_calories(){
        if($this->calories > 0){
            $percent = $this->sugar * self::CONVERT_SUGAR_TO_CALORIES/ $this->calories * 100;
            if($percent > self::LIMIT_PERCENT_SUGAR_ALCOHOL)
                return true;
        }
        return false;
    }
    public function is_high_alcohol_in_calories(){
        if($this->calories > 0){
            $percent = $this->alcohol * self::CONVERT_ALCOHOL_TO_CALORIES/ $this->calories * 100;
            if($percent > self::LIMIT_PERCENT_SUGAR_ALCOHOL)
                return true;
        }
        return false;
    }

    public function rate_carbs_in_calorie(){
        if($this->from_carb !== null && $this->calories > 0){
            $percent = round($this->from_carb/$this->calories*100, 1);
            return $percent;
        }
        return 0;
    }

    public function rate_protein_in_calorie(){
        if($this->from_protein !== null && $this->calories > 0){
            $percent = round($this->from_protein/ $this->calories * 100, 1);
            return $percent;
        }
        return 0;
    }

    public function rate_fat_in_calorie(){
        if($this->from_fat !== null && $this->calories > 0){
            $percent = round($this->from_fat/ $this->calories * 100, 1);
            return $percent;
        }
        return 0;
    }

    public function rate_alcohol_in_calorie(){
        if($this->from_alcohol !== null && $this->calories > 0){
            $percent = round($this->from_alcohol/ $this->calories * 100, 1);
            return $percent;
        }
        return 0;
    }

    public function opinion(){
        $daily_value = array(
            'calcium' => 1000,
            'carbohydrates' => 300,
            'cholesterol' => 300,
            'dietary_fiber' => 27,
            'fat' => 65,
            'iron' => 18,
            'magnesium' => 400,
            'protein' => 50,
            'saturated_fat' => 20,
            'sodium' => 2400,
            'thiamin' => 1.5,
            'vitamin_A' => 5000,
            'vitamin_C' => 60,
            'vitamin_D' => 400,
            'zinc' => 15,
        );

        $source_bad = array(
            'saturated_fat', 'cholesterol', 'sodium'
        );

        $source_good = array(
            'calcium', 'carbohydrates', 'dietary_fiber', 'iron', 'magnesium', 'protein', 'thiamin', 'vitamin_A',
            'vitamin_C', 'vitamin_D', 'zinc', 'phosphorus'
        );

        $opinion_label = array(
            'GOOD_LOW' => 'Chứa ít:',
            'GOOD_VERY_LOW' => 'Chứa rất ít:',
            'GOOD_HIGH' => 'Là nguồn tốt từ:',
            'GOOD_VERY_HIGH' => 'Là nguồn rất tốt từ:',
            'BAD_HIGH' => 'Chứa nhiều:',
            'BAD_VERY_HIGH' => 'Chứa rất nhiều:',
            'INCLUDE_TRANS_FAT' => 'Có chứa Trans Fat',
            'LARGE_PORTION' => 'Một lượng lớn calories đến từ:',
        );

        $opinion = array();
        $opinion_result = array(
            'GOOD' => array(),
            'BAD' => array(),
        );
        if($this->calories < 0){
            return null;
        }
        //check source_bad
        $opinion = $this->checkSourceBad($source_bad, $opinion, $daily_value);
        $opinion = $this->checkSourceGood($source_good, $opinion, $daily_value);
        //check trans fat
        if($this->trans_fat > 0){
            $opinion['INCLUDE_TRANS_FAT'] = TRUE;
        }else{
            $opinion['INCLUDE_TRANS_FAT'] = FALSE;
        }
        //check portion
        $opinion['LARGE_PORTION'] = null;
        if($this->is_high_sugar_in_calories()){
            $opinion['LARGE_PORTION'][] = $this->getAttributeLabel('sugar');
        }

        if($this->is_high_alcohol_in_calories()){
            $opinion['LARGE_PORTION'][] = $this->getAttributeLabel('alcohol');
        }

        foreach($opinion as $key => $value){
            if($key === 'GOOD_LOW' || $key === 'GOOD_VERY_LOW' || $key === 'GOOD_HIGH' || $key === 'GOOD_VERY_HIGH'){
                $opinion_result['GOOD'][] = $opinion_label[$key].' '.implode(', ', $value);
            }elseif($key === 'BAD_HIGH' || $key === 'BAD_VERY_HIGH' || ($key === 'LARGE_PORTION' && $value !== null)){
                $opinion_result['BAD'][] = $opinion_label[$key].' '.implode(', ', $value);
            }elseif($key === 'INCLUDE_TRANS_FAT' && $value === true){
                $opinion_result['BAD'][] = $opinion_label[$key];
            }
        }
        return $opinion_result;
    }

    public function checkSourceBad($source_bad, $opinion, $daily_value){
        foreach($source_bad as $nutrition){
            $level = null;
            if($this->$nutrition != 0){
                //calculate %DV
                $daily_value_percent = (self::OPINION_CALORIE/$this->calories)*$this->$nutrition / $daily_value[$nutrition]*100;
                //check level opinion
                if($daily_value_percent < self::VERY_LOW_LEVEL_PERCENT){
                    $level = 'GOOD_LOW';
                }elseif($daily_value_percent < self::LOW_LEVEL_PERCENT){
                    $level = 'GOOD_VERY_LOW';
                }elseif($daily_value_percent > self::HIGH_LEVEL_PERCENT && $daily_value_percent <= self::HIGH_LEVEL_PERCENT){
                    $level = 'BAD_HIGH';
                }elseif($daily_value_percent > self::VERY_HIGH_LEVEL_PERCENT){
                    $level = 'BAD_VERY_HIGH';
                }
            }else{
                $level = 'GOOD_VERY_LOW';
            }
            if($level != null){
                if(!array_key_exists ($level, $opinion)){
                    $opinion[$level] = [];
                }
                array_push($opinion[$level], $this->getAttributeLabel($nutrition));
            }
        }
        return $opinion;
    }
    public function checkSourceGood($source_good, $opinion, $daily_value){
        foreach($source_good as $nutrition){
            $level = null;
            if($this->$nutrition != 0){
                //calculate %DV
                $daily_value_percent = (self::OPINION_CALORIE/$this->calories)*$this->$nutrition / $daily_value[$nutrition]*100;
                //check level opinion
                if($daily_value_percent > self::HIGH_LEVEL_PERCENT && $daily_value_percent <= self::VERY_HIGH_LEVEL_PERCENT){
                    $level = 'GOOD_HIGH';
                }elseif($daily_value_percent > self::VERY_HIGH_LEVEL_PERCENT){
                    $level = 'GOOD_VERY_HIGH';
                }
            }
            if($level != null){
                if(!array_key_exists ($level, $opinion)){
                    $opinion[$level] = [];
                }
                array_push($opinion[$level], $this->getAttributeLabel($nutrition));
            }
        }
        return $opinion;
    }
}

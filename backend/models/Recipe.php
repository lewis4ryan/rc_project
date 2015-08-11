<?php

namespace app\models;

use Yii;
use yii\db\Expression;
use yii\behaviors\TimestampBehavior;
/**
 * This is the model class for table "recipe".
 *
 * @property integer $id
 * @property string $name
 * @property string $description
 * @property integer $difficulty
 * @property integer $duration
 * @property string $budget
 * @property integer $prepare_time
 * @property integer $category_id
 * @property integer $serving_size
 *
 * @property Album[] $albums
 * @property Image[] $images
 * @property Comment[] $comments
 * @property User[] $users
 * @property Rating[] $ratings
 * @property User[] $users0
 * @property Category $category
 * @property RecipeIngredient[] $recipeIngredients
 * @property Step[] $steps
 * @property UserRecipe[] $userRecipes
 * @property User[] $users1
 * @property Video $video
 */
class Recipe extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'recipe';
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
            [['name', 'difficulty', 'category_id', 'serving_size', 'country_id'], 'required'],
            [['prepare_time_minute', 'duration_minute'], 'required'],
            [['prepare_time_hour', 'prepare_time_minute', 'duration_hour', 'duration_minute', 'created', 'updated'], 'safe'],
            [['description'], 'string'],
            [['difficulty', 'duration', 'category_id', 'serving_size', 'prepare_time_minute', 'prepare_time_hour', 'duration_hour', 'duration_minute'], 'integer'],
            [['budget'], 'number'],
            [['name'], 'string', 'max' => 50],
            [['prepare_time_minute', 'duration_minute'], 'integer', 'max' => 59],
            [
                ['prepare_time_minute'], 'integer', 'min' => 1, 'when' => function($model) {
                    return $model->prepare_time_hour == 0 || $model->prepare_time_hour == null;
                },'whenClient' => "function (attribute, value) {
                    return $('#recipe-prepare_time_hour').val() == '0' || $('#recipe-prepare_time_hour').val() == '';
                }"
            ],
            [
                ['duration_minute'], 'integer', 'min' => 1, 'when' => function($model) {
                    return $model->duration_hour == 0 || $model->duration_hour == null;
                },'whenClient' => "function (attribute, value) {
                    return $('#recipe-duration_hour').val() == '0' || $('#recipe-duration_hour').val() == '';
                }"
            ],
            [['name'],'unique'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Tên',
            'description' => 'Mô tả',
            'difficulty' => 'Độ khó',
            'duration' => 'Thời gian nấu',
            'budget' => 'Ngân sách',
            'prepare_time' => 'Thời gian chuẩn bị',
            'category_id' => 'Thể loại',
            'serving_size' => 'Khẩu phần',
            'created' => 'Ngày tạo',
            'updated' => 'Ngày sửa',
            'prepare_time_hour' => 'Giờ',
            'prepare_time_minute' => 'Phút',
            'duration_hour' => 'Giờ',
            'duration_minute' => 'Phút',
            'country_id' => 'Quốc gia',
        ];
    }
    public $prepare_time_hour;
    public $prepare_time_minute;
    public $duration_hour;
    public $duration_minute;
    CONST DIFFICULTY_EASY = 1;
    CONST DIFFICULTY_MEDIUM = 2;
    CONST DIFFICULTY_HARD = 3;

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAlbums()
    {
        return $this->hasMany(Album::className(), ['recipe_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getImages()
    {
        return $this->hasMany(Image::className(), ['id' => 'image_id'])->viaTable('album', ['recipe_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getComments()
    {
        return $this->hasMany(Comment::className(), ['recipe_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUsers()
    {
        return $this->hasMany(User::className(), ['id' => 'user_id'])->viaTable('comment', ['recipe_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRatings()
    {
        return $this->hasMany(Rating::className(), ['recipe_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUsers0()
    {
        return $this->hasMany(User::className(), ['id' => 'user_id'])->viaTable('rating', ['recipe_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCategory()
    {
        return $this->hasOne(Category::className(), ['id' => 'category_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRecipeIngredients()
    {
        return $this->hasMany(RecipeIngredient::className(), ['recipe_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSteps()
    {
        return $this->hasMany(Step::className(), ['recipe_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUserRecipes()
    {
        return $this->hasMany(UserRecipe::className(), ['recipe_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUsers1()
    {
        return $this->hasMany(User::className(), ['id' => 'user_id'])->viaTable('user_recipe', ['recipe_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getVideo()
    {
        return $this->hasOne(Video::className(), ['recipe_id' => 'id']);
    }

    public function getCountry()
    {
        return $this->hasOne(Country::className(), ['id' => 'country_id']);
    }
    //code
    public function afterFind(){
        if(Yii::$app->controller->id == 'recipe' && Yii::$app->controller->action->id == 'index' ){
            if($this->created != null){
                $this->created = date ('d.m.Y H:i', strtotime ($this->created));
            }
            if($this->updated != null){
                $this->updated = date ('d.m.Y H:i', strtotime ($this->updated));
            }
        }
        $this->prepare_time_minute = $this->prepare_time%60;
        $this->prepare_time_hour = ($this->prepare_time-$this->prepare_time_minute)/60;
        $this->duration_minute = $this->duration%60;
        $this->duration_hour = ($this->duration-$this->duration_minute)/60;
        return parent::afterFind();
    }

    public function afterValidate(){
        if(Yii::$app->controller->id == 'recipe' && Yii::$app->controller->action->id == 'index' ){
            if($this->updated!= null)
                $this->updated=date('Y-m-d', strtotime($this->updated));
            if($this->created!= null)
                $this->created=date('Y-m-d', strtotime($this->created));
        }
        return parent::afterValidate();
    }

    public function beforeValidate(){
        if(Yii::$app->controller->id == 'recipe' && Yii::$app->controller->action->id == 'index' ){
            if($this->updated!= null)
                $this->updated=date('Y-m-d', strtotime($this->updated));
            if($this->created!= null)
                $this->created=date('Y-m-d', strtotime($this->created));
        }

        return parent::beforeValidate();
    }

    public function beforeSave($insert){
        $this->name = ucfirst($this->name);
        if(isset($this->prepare_time_minute) && $this->prepare_time_minute != null){
            $this->prepare_time = $this->prepare_time_hour*60 + $this->prepare_time_minute;
        }
        if(isset($this->duration_minute) && $this->duration_minute != null){
            $this->duration = $this->duration_hour*60 + $this->duration_minute;
        }
        return parent::beforeSave($insert);
    }
    public function getDifficultyList() {
        return array(self::DIFFICULTY_EASY => 'Dễ', self::DIFFICULTY_MEDIUM => 'Vừa', self::DIFFICULTY_HARD => 'Khó');
    }
    public function getDifficulty($type) {
        $temp = self::getDifficultyList();
        return $temp[$type];
    }
    public function getServingList() {
        return array('1','2','3','4','5','6','7','8','9','10','11','12','13','14','15','16','17','18','19','20');
    }
    public function getPrepareTimeList() {
        return array(5=>'5 phút', 15=>'15 phút', 30=>'30 phút', 60=>'1 tiếng', 90=>'1 tiếng 30 phút' );
    }
    public function getDurationList() {
        return array(5=>'5 phút', 15=>'15 phút', 30=>'30 phút', 60=>'1 giờ', 90=>'1 tiếng 30 phút', 2=>'2 tiếng' );
    }
}

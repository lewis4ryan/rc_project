<?php

namespace app\models;

use Yii;
use yii\base\NotSupportedException;
use yii\db\ActiveRecord;
use yii\helpers\Security;
use yii\web\IdentityInterface;

/**
 * This is the model class for table "user".
 *
 * @property integer $id
 * @property integer $role
 * @property string $username
 * @property string $password
 * @property string $email
 * @property string $first_name
 * @property string $last_name
 * @property boolean $gender
 * @property string $date_of_birth
 * @property string $phone
 * @property string $picture
 * @property string $street_number
 * @property string $postcode
 * @property string $city
 * @property integer $country_id
 * @property string $verify_code
 * @property string $session_id
 * @property string $created
 * @property string $updated
 * @property string $facebook_id
 * @property integer $status
 *
 * @property Comment[] $comments
 * @property Recipe[] $recipes
 * @property Rating[] $ratings
 * @property Recipe[] $recipes0
 * @property Shopping[] $shoppings
 * @property UserRecipe[] $userRecipes
 * @property Recipe[] $recipes1
 */
class User extends \yii\db\ActiveRecord implements IdentityInterface
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'user';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['role', 'country_id', 'status'], 'integer'],
            [['username', 'password', 'email', 'first_name', 'last_name', 'date_of_birth', 'status'], 'required'],
            [['gender'], 'boolean'],
            [['date_of_birth', 'created', 'updated'], 'safe'],
            [['username', 'password', 'email', 'facebook_id'], 'string', 'max' => 128],
            [['first_name', 'last_name', 'picture'], 'string', 'max' => 255],
            [['phone'], 'string', 'max' => 20],
            [['street_number'], 'string', 'max' => 100],
            [['postcode', 'city'], 'string', 'max' => 50],
            [['verify_code', 'session_id'], 'string', 'max' => 64]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'role' => 'Role',
            'username' => 'Username',
            'password' => 'Password',
            'email' => 'Email',
            'first_name' => 'First Name',
            'last_name' => 'Last Name',
            'gender' => 'Gender',
            'date_of_birth' => 'Date Of Birth',
            'phone' => 'Phone',
            'picture' => 'Picture',
            'street_number' => 'Street Number',
            'postcode' => 'Postcode',
            'city' => 'City',
            'country_id' => 'Country ID',
            'verify_code' => 'Verify Code',
            'session_id' => 'Session ID',
            'created' => 'Created',
            'updated' => 'Updated',
            'facebook_id' => 'Facebook ID',
            'status' => 'Status',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getComments()
    {
        return $this->hasMany(Comment::className(), ['user_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRecipes()
    {
        return $this->hasMany(Recipe::className(), ['id' => 'recipe_id'])->viaTable('comment', ['user_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRatings()
    {
        return $this->hasMany(Rating::className(), ['user_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRecipes0()
    {
        return $this->hasMany(Recipe::className(), ['id' => 'recipe_id'])->viaTable('rating', ['user_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getShoppings()
    {
        return $this->hasMany(Shopping::className(), ['user_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUserRecipes()
    {
        return $this->hasMany(UserRecipe::className(), ['user_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRecipes1()
    {
        return $this->hasMany(Recipe::className(), ['id' => 'recipe_id'])->viaTable('user_recipe', ['user_id' => 'id']);
    }

    //implement code
    /** INCLUDE USER LOGIN VALIDATION FUNCTIONS**/
    /**
     * @inheritdoc
     */
    public static function findIdentity($id)
    {
        return static::findOne($id);
    }

    /**
     * @inheritdoc
     */
    /* modified */
    public static function findIdentityByAccessToken($token, $type = null)
    {
        return static::findOne(['access_token' => $token]);
    }

    /* removed
        public static function findIdentityByAccessToken($token)
        {
            throw new NotSupportedException('"findIdentityByAccessToken" is not implemented.');
        }
    */
    /**
     * Finds user by username
     *
     * @param  string      $username
     * @return static|null
     */
    public static function findByUsername($username)
    {
        return static::findOne(['username' => $username]);
    }

    /**
     * Finds user by password reset token
     *
     * @param  string      $token password reset token
     * @return static|null
     */
    public static function findByPasswordResetToken($token)
    {
        $expire = \Yii::$app->params['user.passwordResetTokenExpire'];
        $parts = explode('_', $token);
        $timestamp = (int) end($parts);
        if ($timestamp + $expire < time()) {
            // token expired
            return null;
        }

        return static::findOne([
            'password_reset_token' => $token
        ]);
    }

    /**
     * @inheritdoc
     */
    public function getId()
    {
        return $this->getPrimaryKey();
    }

    /**
     * @inheritdoc
     */
    public function getAuthKey()
    {
        return $this->auth_key;
    }

    /**
     * @inheritdoc
     */
    public function validateAuthKey($authKey)
    {
        return $this->getAuthKey() === $authKey;
    }

    /**
     * Validates password
     *
     * @param  string  $password password to validate
     * @return boolean if password provided is valid for current user
     */
    public function validatePassword($password)
    {
        return $this->password === sha1($password);
    }

    /**
     * Generates password hash from password and sets it to the model
     *
     * @param string $password
     */
    public function setPassword($password)
    {
        $this->password_hash = Security::generatePasswordHash($password);
    }

    /**
     * Generates "remember me" authentication key
     */
    public function generateAuthKey()
    {
        $this->auth_key = Security::generateRandomKey();
    }

    /**
     * Generates new password reset token
     */
    public function generatePasswordResetToken()
    {
        $this->password_reset_token = Security::generateRandomKey() . '_' . time();
    }

    /**
     * Removes password reset token
     */
    public function removePasswordResetToken()
    {
        $this->password_reset_token = null;
    }
    /** EXTENSION MOVIE **/
}

<?php

namespace backend\controllers;

use app\models\IngredientUnit;
use app\models\Measureunit;
use common\models\User;
use Yii;
use app\models\Ingredient;
use app\models\IngredientSearch;
use app\models\UploadForm;
use yii\base\Model;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;
use yii\db\ActiveRecord;

/**
 * IngredientController implements the CRUD actions for Ingredient model.
 */
class IngredientController extends Controller
{
    public $enableCsrfValidation = false;
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['post'],
                ],
            ],
        ];
    }

    /**
     * Lists all Ingredient models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new IngredientSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Ingredient model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        $this->findModel($id)->rate_carbs_in_calorie();
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Ingredient model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */

    public function actionCreate()
    {
        $model = new Ingredient();
        $ingredient_units = new IngredientUnit();

        if ($model->load(Yii::$app->request->post())){
            if(isset(Yii::$app->request->post()['IngredientUnit'])){
                //begin trans
                $connection = Yii::$app->db;
                $transaction = $connection->beginTransaction();
                try {// T-command
                    //get image
                    $uploadModel=new UploadForm;
                    $uploadModel->imageFile = UploadedFile::getInstance($model, 'picture');
                    $uploadModel->url=Yii::$app->basePath.'/web/upload/ingredient';

                    //validate upload
                    if($uploadModel->validate()){
                        $model->picture=$uploadModel->imageFile->name;
                        //validate data
                        if($model->validate()){
                            //start upload image
                            if($uploadModel->upload()){
                                $model->picture=$uploadModel->renamed;
                                //start save data
                                if($model->save()){
                                    //save ingredient
                                    foreach($_POST['IngredientUnit'] as $ingredient_unit){
                                        $ingredient_units= new IngredientUnit();
                                        $ingredient_units->attributes = $ingredient_unit;
                                        $ingredient_units->ingre_id = $model->id;
                                        if($ingredient_units->validate()){
                                            $ingredient_units->save();
                                        }
                                    }
                                    $transaction->commit();//successful
                                    return $this->redirect(['view', 'id' => $model->id]);
                                }
                            }else{
                                \Yii::$app->getSession()->setFlash('error', 'Upload hình ảnh: xảy ra lỗi');
                            }
                        }
                    }else{
                        \Yii::$app->getSession()->setFlash('error', 'Hình ảnh phải đúng định dạng: jpg, png, gif');
                    }
                } catch (Exception $e) {
                    $transaction->rollBack();
                    //remove image
                    if($uploadModel->renamed)
                        if(file_exists(Yii::$app->basePath.'/web/upload/ingredient/'.$uploadModel->renamed))
                            @unlink(Yii::$app->basePath.'/web/upload/ingredient/'.$uploadModel->renamed);
                    throw $e;
                }
                //end trans
            }else{
                \Yii::$app->getSession()->setFlash('error', 'Bạn chưa chọn đơn vị');
            }
        }
        return $this->render('create', [
            'model' => $model,
            'ingredient_units' => $ingredient_units
        ]);
    }

    /**
     * Updates an existing Ingredient model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $ingredient_units= $model->ingredientUnits;
        $old_filename = $model->picture;

        if ($model->load(Yii::$app->request->post())) {
            if(isset(Yii::$app->request->post()['IngredientUnit'])){

                //begin trans
                $connection = Yii::$app->db;
                $transaction = $connection->beginTransaction('Serializable');
                try {// T-command
                    //get image
                    $uploadModel=new UploadForm;

                    $uploadModel->imageFile = UploadedFile::getInstance($model, 'picture');
                    $uploadModel->url=Yii::$app->basePath.'/web/upload/ingredient';
                    //validate upload
                    if(!empty($uploadModel->imageFile)){
                        if($uploadModel->validate()){
                            $model->picture=$uploadModel->imageFile->name;
                        }else{
                            \Yii::$app->getSession()->setFlash('error', 'Hình ảnh phải đúng định dạng: jpg, png, gif');
                            return $this->render('update', [
                                'model' => $model,
                                'ingredient_units' => $ingredient_units,
                            ]);
                        }
                    }else{
                        $model->picture = $old_filename;
                    }

                    //validate data
                    if($model->validate()){
                        //start upload image
                        if(!empty($uploadModel->imageFile)){
                            if($uploadModel->upload()){
                                $model->picture=$uploadModel->renamed;
                                if(file_exists(Yii::$app->basePath.'/web/upload/ingredient/'.$old_filename))
                                    @unlink(Yii::$app->basePath.'/web/upload/ingredient/'.$old_filename);
                            }else{
                                \Yii::$app->getSession()->setFlash('error', 'Upload hình ảnh: xảy ra lỗi');
                            }
                        }

                        //start save data
                        if($model->save()){
                            //save ingredient
                            IngredientUnit::deleteAll(array('ingre_id' => $model->id));
                            foreach($_POST['IngredientUnit'] as $ingredient_unit){
                                $ingredient_units= new IngredientUnit();
                                $ingredient_units->attributes = $ingredient_unit;
                                $ingredient_units->ingre_id = $model->id;
                                if($ingredient_units->validate()){
                                    $ingredient_units->save();
                                }
                            }
                            $transaction->commit();//successful
                            return $this->redirect(['view', 'id' => $model->id]);
                        }
                    }
                } catch (Exception $e) {
                    $transaction->rollBack();
                    //remove image
                    if($uploadModel->renamed)
                        if(file_exists(Yii::$app->basePath.'/web/upload/ingredient/'.$uploadModel->renamed))
                            @unlink(Yii::$app->basePath.'/web/upload/ingredient/'.$uploadModel->renamed);
                    throw $e;
                }
                //end trans
            }else{
                // not select ingredient
                \Yii::$app->getSession()->setFlash('error', 'Bạn chưa chọn đơn vị');
            }
        }
        return $this->render('update', [
            'model' => $model,
            'ingredient_units' => $ingredient_units,
        ]);
    }

    /**
     * Deletes an existing Ingredient model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $model = $this->findModel($id);
        if($model){
            if($model->delete()){
                if(file_exists(Yii::$app->basePath.'/web/upload/ingredient/'.$model->picture))
                    @unlink(Yii::$app->basePath.'/web/upload/ingredient/'.$model->picture);
                \Yii::$app->getSession()->setFlash('success', 'Xóa thành công');
            }else{
                \Yii::$app->getSession()->setFlash('error', 'Xóa không thành công');
            }
        }else{
            \Yii::$app->getSession()->setFlash('error', 'Lỗi không tồn tại hoặc đã bị xóa');
        }


        return $this->redirect(['index']);
    }

    /**
     * Finds the Ingredient model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Ingredient the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Ingredient::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('Không tìm thấy trang');
        }
    }

    public function actionImport(){
        $fileUpload = UploadedFile::getInstanceByName('nutrition_txt');
        $url = Yii::$app->basePath.'/web/upload/file/import_ingredient';
        if(!empty($fileUpload)) {
            $name =  $fileUpload;
            while (file_exists($url.'/'.$name)){
                $random = new UploadForm();
                $name = $random->randomFileName($name);
            }
            if($fileUpload->saveAs($url.'/'.$name) !== FALSE){
                $file = fopen($url.'/'.$name,'r+');
                $result = array();
                while(!feof($file))
                {
                    $row = fgets($file);
                    if(strpos($row, 'Calories') !== FALSE && strpos($row, '%') !== FALSE){
                        $start = strpos($row, '(');
                        $str = substr($row, $start, strlen($row)-$start) ;
                        $value = str_replace(array('Calories', $str), '', $row);
                        $value = trim(str_replace('~', '', $value));
                        $result['calories'] = $value;
                    }
                    if(strpos($row, 'From Carbohydrate') !== FALSE){
                        $start = strpos($row, '(');
                        $str = substr($row, $start, strlen($row)-$start) ;
                        $value = str_replace(array('From Carbohydrate', $str), '', $row);
                        $value = trim(str_replace('~', '', $value));
                        $result['from_carb'] = $value;
                    }
                    if(strpos($row, 'From Fat') !== FALSE){
                        $start = strpos($row, '(');
                        $str = substr($row, $start, strlen($row)-$start) ;
                        $value = str_replace(array('From Fat', $str), '', $row);
                        $value = trim(str_replace('~', '', $value));
                        $result['from_fat'] = $value;
                    }
                    if(strpos($row, 'From Protein') !== FALSE){
                        $start = strpos($row, '(');
                        $str = substr($row, $start, strlen($row)-$start) ;
                        $value = str_replace(array('From Protein', $str), '', $row);
                        $value = trim(str_replace('~', '', $value));
                        $result['from_protein'] = $value;
                    }
                    if(strpos($row, 'From Alcohol') !== FALSE){
                        $start = strpos($row, '(');
                        $str = substr($row, $start, strlen($row)-$start) ;
                        $value = str_replace(array('From Alcohol', $str), '', $row);
                        $value = trim(str_replace('~', '', $value));
                        $result['from_alcohol'] = $value;
                    }
                    if(strpos($row, 'Total Carbohydrate') !== FALSE){
                        $start = strrpos($row, 'g');
                        $str = substr($row, $start, strlen($row)-$start) ;
                        $value = str_replace(array('Total Carbohydrate', $str), '', $row);
                        $value = trim(str_replace('~', '', $value));
                        $result['carbohydrates'] = $value;
                    }
                    if(strpos($row, 'Dietary Fiber') !== FALSE){
                        $start = strrpos($row, 'g');
                        $str = substr($row, $start, strlen($row)-$start) ;
                        $value = str_replace(array('Dietary Fiber', $str), '', $row);
                        $value = trim(str_replace('~', '', $value));
                        $result['dietary_fiber'] = $value;
                    }
                    if(strpos($row, 'Starch') !== FALSE){
                        $start = strrpos($row, 'g');
                        $str = substr($row, $start, strlen($row)-$start) ;
                        $value = str_replace(array('Starch', $str), '', $row);
                        $value = trim(str_replace('~', '', $value));
                        $result['starch'] = $value;
                    }
                    if(strpos($row, 'Sugars') !== FALSE){
                        $start = strpos($row, '.')+2;
                        $str = substr($row, $start, strlen($row)-$start) ;
                        $value = str_replace(array('Sugars', $str), '', $row);
                        $value = trim(str_replace('~', '', $value));
                        $result['sugar'] = $value;
                    }
                    if(strpos($row, 'Sugars') !== FALSE){
                        $start = strrpos($row, 'g');
                        $str = substr($row, $start, strlen($row)-$start) ;
                        $value = str_replace(array('Sugars', $str), '', $row);
                        $value = trim(str_replace('~', '', $value));
                        $result['sugar'] = $value;
                    }
                    if(strpos($row, 'Total Fat') !== FALSE){
                        $start = strrpos($row, 'g');
                        $str = substr($row, $start, strlen($row)-$start) ;
                        $value = str_replace(array('Total Fat', $str), '', $row);
                        $value = trim(str_replace('~', '', $value));
                        $result['fat'] = $value;
                    }
                    if(strpos($row, 'Saturated Fat') !== FALSE){
                        $start = strrpos($row, 'g');
                        $str = substr($row, $start, strlen($row)-$start) ;
                        $value = str_replace(array('Saturated Fat', $str), '', $row);
                        $value = trim(str_replace('~', '', $value));
                        $result['saturated_fat'] = $value;
                    }
                    if(strpos($row, 'Monounsaturated Fat') !== FALSE){
                        $start = strrpos($row, 'g');
                        $str = substr($row, $start, strlen($row)-$start) ;
                        $value = str_replace(array('Monounsaturated Fat', $str), '', $row);
                        $value = trim(str_replace('~', '', $value));
                        $result['monounsaturated'] = $value;
                    }
                    if(strpos($row, 'Polyunsaturated Fat') !== FALSE){
                        $start = strrpos($row, 'g');
                        $str = substr($row, $start, strlen($row)-$start) ;
                        $value = str_replace(array('Polyunsaturated Fat', $str), '', $row);
                        $value = trim(str_replace('~', '', $value));
                        $result['polyunsaturated'] = $value;
                    }
                    if(strpos($row, 'Total Omega-3 fatty acids') !== FALSE){
                        $start = strrpos($row, 'mg');
                        $str = substr($row, $start, strlen($row)-$start) ;
                        $value = str_replace(array('Total Omega-3 fatty acids', $str), '', $row);
                        $value = trim(str_replace('~', '', $value));
                        $result['omega_3'] = $value;
                    }
                    if(strpos($row, 'Total Omega-6 fatty acids') !== FALSE){
                        $start = strrpos($row, 'mg');
                        $str = substr($row, $start, strlen($row)-$start) ;
                        $value = str_replace(array('Total Omega-6 fatty acids', $str), '', $row);
                        $value = trim(str_replace('~', '', $value));
                        $result['omega_6'] = $value;
                    }
                    if(strpos($row, 'Total trans-monoenoic fatty acids') !== FALSE){
                        $start = strrpos($row, 'g');
                        $str = substr($row, $start, strlen($row)-$start) ;
                        $value = str_replace(array('Total trans-monoenoic fatty acids', $str), '', $row);
                        $value = trim(str_replace('~', '', $value));
                        $result['trans_monoenoic'] = $value;
                    }
                    if(strpos($row, 'Total trans-polyenoic fatty acids') !== FALSE){
                        $start = strrpos($row, 'g');
                        $str = substr($row, $start, strlen($row)-$start) ;
                        $value = str_replace(array('Total trans-polyenoic fatty acids', $str), '', $row);
                        $value = trim(str_replace('~', '', $value));
                        $result['trans_polyenoic'] = $value;
                    }

                    //protein
                    if(strpos($row, 'Protein') !== FALSE && strpos($row, '%') !== FALSE){
                        $start = strrpos($row, 'g');
                        $str = substr($row, $start, strlen($row)-$start) ;
                        $value = str_replace(array('Protein', $str), '', $row);
                        $value = trim(str_replace('~', '', $value));
                        $result['protein'] = $value;
                    }
                    //vitamin
                    if(strpos($row, 'Sodium') !== FALSE && strpos($row, '%') !== FALSE){
                        $start = strpos($row, 'mg');
                        $str = substr($row, $start, strlen($row)-$start) ;
                        $value = str_replace(array('Sodium', $str), '', $row);
                        $value = trim(str_replace('~', '', $value));
                        $result['sodium'] = $value;
                    }

                    if(strpos($row, 'Calcium') !== FALSE && strpos($row, '%') !== FALSE){
                        $start = strrpos($row, 'mg');
                        $str = substr($row, $start, strlen($row)-$start) ;
                        $value = str_replace(array('Calcium', $str), '', $row);
                        $value = trim(str_replace('~', '', $value));
                        $result['calcium'] = $value;
                    }

                    if(strpos($row, 'Iron') !== FALSE && strpos($row, '%') !== FALSE){
                        $start = strrpos($row, 'mg');
                        $str = substr($row, $start, strlen($row)-$start) ;
                        $value = str_replace(array('Iron', $str), '', $row);
                        $value = trim(str_replace('~', '', $value));
                        $result['iron'] = $value;
                    }

                    if(strpos($row, 'Vitamin A') !== FALSE && strpos($row, '%') !== FALSE){
                        $start = strrpos($row, 'IU');
                        $str = substr($row, $start, strlen($row)-$start) ;
                        $value = str_replace(array('Vitamin A', $str), '', $row);
                        $value = trim(str_replace('~', '', $value));
                        $result['vitamin_a'] = $value;
                    }
                    if(strpos($row, 'Vitamin C') !== FALSE && strpos($row, '%') !== FALSE){
                        $start = strrpos($row, 'mg');
                        $str = substr($row, $start, strlen($row)-$start) ;
                        $value = str_replace(array('Vitamin C', $str), '', $row);
                        $value = trim(str_replace('~', '', $value));
                        $result['vitamin_c'] = $value;
                    }
                    if(strpos($row, 'Zinc') !== FALSE && strpos($row, '%') !== FALSE){
                        $start = strrpos($row, 'mg');
                        $str = substr($row, $start, strlen($row)-$start) ;
                        $value = str_replace(array('Zinc', $str), '', $row);
                        $value = trim(str_replace('~', '', $value));
                        $result['zinc'] = $value;
                    }
                    if(strpos($row, 'Thiamin') !== FALSE && strpos($row, '%') !== FALSE){
                        $start = strrpos($row, 'mg');
                        $str = substr($row, $start, strlen($row)-$start) ;
                        $value = str_replace(array('Thiamin', $str), '', $row);
                        $value = trim(str_replace('~', '', $value));
                        $result['thiamin'] = $value;
                    }
                    if(strpos($row, 'Magnesium') !== FALSE && strpos($row, '%') !== FALSE){
                        $start = strrpos($row, 'mg');
                        $str = substr($row, $start, strlen($row)-$start) ;
                        $value = str_replace(array('Magnesium', $str), '', $row);
                        $value = trim(str_replace('~', '', $value));
                        $result['magnesium'] = $value;
                    }
                    if(strpos($row, 'Water') !== FALSE){
                        $start = strrpos($row, 'g');
                        $str = substr($row, $start, strlen($row)-$start) ;
                        $value = str_replace(array('Water', $str), '', $row);
                        $value = trim(str_replace('~', '', $value));
                        $result['water'] = $value;
                    }

                    if(strpos($row, 'Caffeine') !== FALSE){
                        $start = strrpos($row, 'mg');
                        $str = substr($row, $start, strlen($row)-$start) ;
                        $value = str_replace(array('Caffeine', $str), '', $row);
                        $value = trim(str_replace('~', '', $value));
                        $result['caffeine'] = $value;
                    }

                    if(strpos($row, 'Alcohol') !== FALSE){
                        $start = strrpos($row, 'g');
                        $str = substr($row, $start, strlen($row)-$start) ;
                        $value = str_replace(array('Alcohol', $str), '', $row);
                        $value = trim(str_replace('~', '', $value));
                        $result['alcohol'] = $value;
                    }

                    if(strpos($row, 'Cholesterol') !== FALSE){
                        $start = strrpos($row, 'mg');
                        $str = substr($row, $start, strlen($row)-$start) ;
                        $value = str_replace(array('Cholesterol', $str), '', $row);
                        $value = trim(str_replace('~', '', $value));
                        $result['cholesterol'] = $value;
                    }
                }
                fclose($file);
                @unlink($url.'/'.$name);
                header('Content-type: application/json');
                echo json_encode($result);
                return;
            }
        }
    }
}

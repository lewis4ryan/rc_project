<?php

namespace backend\controllers;

use Yii;
use app\models\RecipeIngredient;
use app\models\RecipeIngredientSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * RecipeIngredientController implements the CRUD actions for RecipeIngredient model.
 */
class RecipeIngredientController extends Controller
{
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
     * Lists all RecipeIngredient models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new RecipeIngredientSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single RecipeIngredient model.
     * @param integer $recipe_id
     * @param integer $ingre_id
     * @param integer $measure_unit_id
     * @return mixed
     */
    public function actionView($recipe_id, $ingre_id, $measure_unit_id)
    {
        return $this->render('view', [
            'model' => $this->findModel($recipe_id, $ingre_id, $measure_unit_id),
        ]);
    }

    /**
     * Creates a new RecipeIngredient model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new RecipeIngredient();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'recipe_id' => $model->recipe_id, 'ingre_id' => $model->ingre_id, 'measure_unit_id' => $model->measure_unit_id]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing RecipeIngredient model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $recipe_id
     * @param integer $ingre_id
     * @param integer $measure_unit_id
     * @return mixed
     */
    public function actionUpdate($recipe_id, $ingre_id, $measure_unit_id)
    {
        $model = $this->findModel($recipe_id, $ingre_id, $measure_unit_id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'recipe_id' => $model->recipe_id, 'ingre_id' => $model->ingre_id, 'measure_unit_id' => $model->measure_unit_id]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing RecipeIngredient model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $recipe_id
     * @param integer $ingre_id
     * @param integer $measure_unit_id
     * @return mixed
     */
    public function actionDelete($recipe_id, $ingre_id, $measure_unit_id)
    {
        $this->findModel($recipe_id, $ingre_id, $measure_unit_id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the RecipeIngredient model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $recipe_id
     * @param integer $ingre_id
     * @param integer $measure_unit_id
     * @return RecipeIngredient the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($recipe_id, $ingre_id, $measure_unit_id)
    {
        if (($model = RecipeIngredient::findOne(['recipe_id' => $recipe_id, 'ingre_id' => $ingre_id, 'measure_unit_id' => $measure_unit_id])) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}

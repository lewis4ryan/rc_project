<?php

namespace backend\controllers;

use Yii;
use app\models\IngredientNutrition;
use app\models\IngredientNutritionSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * IngredientNutritionController implements the CRUD actions for IngredientNutrition model.
 */
class IngredientNutritionController extends Controller
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
     * Lists all IngredientNutrition models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new IngredientNutritionSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single IngredientNutrition model.
     * @param integer $ingre_id
     * @param integer $nutri_id
     * @return mixed
     */
    public function actionView($ingre_id, $nutri_id)
    {
        return $this->render('view', [
            'model' => $this->findModel($ingre_id, $nutri_id),
        ]);
    }

    /**
     * Creates a new IngredientNutrition model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new IngredientNutrition();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'ingre_id' => $model->ingre_id, 'nutri_id' => $model->nutri_id]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing IngredientNutrition model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $ingre_id
     * @param integer $nutri_id
     * @return mixed
     */
    public function actionUpdate($ingre_id, $nutri_id)
    {
        $model = $this->findModel($ingre_id, $nutri_id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'ingre_id' => $model->ingre_id, 'nutri_id' => $model->nutri_id]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing IngredientNutrition model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $ingre_id
     * @param integer $nutri_id
     * @return mixed
     */
    public function actionDelete($ingre_id, $nutri_id)
    {
        $this->findModel($ingre_id, $nutri_id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the IngredientNutrition model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $ingre_id
     * @param integer $nutri_id
     * @return IngredientNutrition the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($ingre_id, $nutri_id)
    {
        if (($model = IngredientNutrition::findOne(['ingre_id' => $ingre_id, 'nutri_id' => $nutri_id])) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}

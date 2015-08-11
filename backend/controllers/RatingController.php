<?php

namespace backend\controllers;

use Yii;
use app\models\Rating;
use app\models\RatingSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * RatingController implements the CRUD actions for Rating model.
 */
class RatingController extends Controller
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
     * Lists all Rating models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new RatingSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Rating model.
     * @param integer $user_id
     * @param integer $recipe_id
     * @return mixed
     */
    public function actionView($user_id, $recipe_id)
    {
        return $this->render('view', [
            'model' => $this->findModel($user_id, $recipe_id),
        ]);
    }

    /**
     * Creates a new Rating model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Rating();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'user_id' => $model->user_id, 'recipe_id' => $model->recipe_id]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing Rating model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $user_id
     * @param integer $recipe_id
     * @return mixed
     */
    public function actionUpdate($user_id, $recipe_id)
    {
        $model = $this->findModel($user_id, $recipe_id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'user_id' => $model->user_id, 'recipe_id' => $model->recipe_id]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing Rating model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $user_id
     * @param integer $recipe_id
     * @return mixed
     */
    public function actionDelete($user_id, $recipe_id)
    {
        $this->findModel($user_id, $recipe_id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Rating model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $user_id
     * @param integer $recipe_id
     * @return Rating the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($user_id, $recipe_id)
    {
        if (($model = Rating::findOne(['user_id' => $user_id, 'recipe_id' => $recipe_id])) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}

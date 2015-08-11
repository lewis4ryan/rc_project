<?php

namespace backend\controllers;

use Yii;
use app\models\UserRecipe;
use app\models\UserRecipeSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * UserRecipeController implements the CRUD actions for UserRecipe model.
 */
class UserRecipeController extends Controller
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
     * Lists all UserRecipe models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new UserRecipeSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single UserRecipe model.
     * @param integer $recipe_id
     * @param integer $user_id
     * @return mixed
     */
    public function actionView($recipe_id, $user_id)
    {
        return $this->render('view', [
            'model' => $this->findModel($recipe_id, $user_id),
        ]);
    }

    /**
     * Creates a new UserRecipe model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new UserRecipe();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'recipe_id' => $model->recipe_id, 'user_id' => $model->user_id]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing UserRecipe model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $recipe_id
     * @param integer $user_id
     * @return mixed
     */
    public function actionUpdate($recipe_id, $user_id)
    {
        $model = $this->findModel($recipe_id, $user_id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'recipe_id' => $model->recipe_id, 'user_id' => $model->user_id]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing UserRecipe model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $recipe_id
     * @param integer $user_id
     * @return mixed
     */
    public function actionDelete($recipe_id, $user_id)
    {
        $this->findModel($recipe_id, $user_id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the UserRecipe model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $recipe_id
     * @param integer $user_id
     * @return UserRecipe the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($recipe_id, $user_id)
    {
        if (($model = UserRecipe::findOne(['recipe_id' => $recipe_id, 'user_id' => $user_id])) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}

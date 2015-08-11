<?php

namespace backend\controllers;

use Yii;
use app\models\Shopping;
use app\models\ShoppingSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * ShoppingController implements the CRUD actions for Shopping model.
 */
class ShoppingController extends Controller
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
     * Lists all Shopping models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new ShoppingSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Shopping model.
     * @param integer $user_id
     * @param integer $ingre_id
     * @param integer $measure_unit_id
     * @return mixed
     */
    public function actionView($user_id, $ingre_id, $measure_unit_id)
    {
        return $this->render('view', [
            'model' => $this->findModel($user_id, $ingre_id, $measure_unit_id),
        ]);
    }

    /**
     * Creates a new Shopping model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Shopping();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'user_id' => $model->user_id, 'ingre_id' => $model->ingre_id, 'measure_unit_id' => $model->measure_unit_id]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing Shopping model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $user_id
     * @param integer $ingre_id
     * @param integer $measure_unit_id
     * @return mixed
     */
    public function actionUpdate($user_id, $ingre_id, $measure_unit_id)
    {
        $model = $this->findModel($user_id, $ingre_id, $measure_unit_id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'user_id' => $model->user_id, 'ingre_id' => $model->ingre_id, 'measure_unit_id' => $model->measure_unit_id]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing Shopping model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $user_id
     * @param integer $ingre_id
     * @param integer $measure_unit_id
     * @return mixed
     */
    public function actionDelete($user_id, $ingre_id, $measure_unit_id)
    {
        $this->findModel($user_id, $ingre_id, $measure_unit_id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Shopping model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $user_id
     * @param integer $ingre_id
     * @param integer $measure_unit_id
     * @return Shopping the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($user_id, $ingre_id, $measure_unit_id)
    {
        if (($model = Shopping::findOne(['user_id' => $user_id, 'ingre_id' => $ingre_id, 'measure_unit_id' => $measure_unit_id])) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}

<?php

namespace backend\controllers;

use Yii;
use app\models\IngredientUnit;
use app\models\IngredientUnitSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * IngredientUnitController implements the CRUD actions for IngredientUnit model.
 */
class IngredientUnitController extends Controller
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
     * Lists all IngredientUnit models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new IngredientUnitSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single IngredientUnit model.
     * @param integer $ingre_id
     * @param integer $measureunit_id
     * @return mixed
     */
    public function actionView($ingre_id, $measureunit_id)
    {
        return $this->render('view', [
            'model' => $this->findModel($ingre_id, $measureunit_id),
        ]);
    }

    /**
     * Creates a new IngredientUnit model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new IngredientUnit();

        if ($model->load(Yii::$app->request->post()) && $model->validate() && $model->save()) {
            return $this->redirect(['view', 'ingre_id' => $model->ingre_id, 'measureunit_id' => $model->measureunit_id]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing IngredientUnit model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $ingre_id
     * @param integer $measureunit_id
     * @return mixed
     */
    public function actionUpdate($ingre_id, $measureunit_id)
    {
        $model = $this->findModel($ingre_id, $measureunit_id);

        if ($model->load(Yii::$app->request->post()) && $model->validate() && $model->save()) {
            return $this->redirect(['view', 'ingre_id' => $model->ingre_id, 'measureunit_id' => $model->measureunit_id]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing IngredientUnit model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $ingre_id
     * @param integer $measureunit_id
     * @return mixed
     */
    public function actionDelete($ingre_id, $measureunit_id)
    {
        $this->findModel($ingre_id, $measureunit_id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the IngredientUnit model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $ingre_id
     * @param integer $measureunit_id
     * @return IngredientUnit the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($ingre_id, $measureunit_id)
    {
        if (($model = IngredientUnit::findOne(['ingre_id' => $ingre_id, 'measureunit_id' => $measureunit_id])) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}

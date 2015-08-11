<?php

namespace backend\controllers;

use Yii;
use app\models\Nutriunit;
use app\models\NutriunitSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\db\Transaction;

/**
 * NutriunitController implements the CRUD actions for Nutriunit model.
 */
class NutriunitController extends Controller
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
     * Lists all Nutriunit models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new NutriunitSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        //return the $dataProvider
        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Nutriunit model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Nutriunit model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Nutriunit();
        if ($model->load(Yii::$app->request->post())) {
            //begin trans
            $connection = Yii::$app->db;
            $transaction = $connection->beginTransaction();
            try {
                // T-command
                if($model->validate() && $model->save()){
                    //successful
                }
                $transaction->commit();
                return $this->redirect(['view', 'id' => $model->id]);
            } catch (Exception $e) {
                $transaction->rollBack();
                throw $e;
            }
            //end trans
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing Nutriunit model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post())) {
            //begin trans
            $connection = Yii::$app->db;
            $transaction = $connection->beginTransaction('Serializable');
            try {
                // T-command
                if($model->validate() && $model->save() ){
                    //successful
                }

                $transaction->commit();
                return $this->redirect(['view', 'id' => $model->id]);
            } catch (Exception $e) {
                $transaction->rollBack();
                throw $e;
            }
            //end trans
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing Nutriunit model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        //begin trans
        $connection = Yii::$app->db;
        $transaction = $connection->beginTransaction('Serializable');
        try {
            // T-command
            $this->findModel($id)->delete();
            $transaction->commit();
            return $this->redirect(['index']);
        } catch (Exception $e) {
            $transaction->rollBack();
            throw $e;
        }
        //end trans

    }

    /**
     * Finds the Nutriunit model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Nutriunit the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Nutriunit::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}

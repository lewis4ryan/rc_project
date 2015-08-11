<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\StepSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Steps';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="step-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Step', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'step_number',
            'content:ntext',
            'recipe_id',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>

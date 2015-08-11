<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\IngredientUnitSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Ingredient Units';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ingredient-unit-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Ingredient Unit', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'ingre_id',
            'measureunit_id',
            'weight',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>

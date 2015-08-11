<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\IngredientNutritionSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Ingredient Nutritions';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ingredient-nutrition-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Ingredient Nutrition', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'ingre_id',
            'nutri_id',
            'quantity',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>

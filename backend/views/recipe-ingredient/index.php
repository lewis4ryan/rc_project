<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\RecipeIngredientSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Recipe Ingredients';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="recipe-ingredient-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Recipe Ingredient', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'recipe_id',
            'ingre_id',
            'measure_unit_id',
            'quantity',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>

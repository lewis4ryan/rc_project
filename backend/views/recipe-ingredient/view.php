<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\RecipeIngredient */

$this->title = $model->recipe_id;
$this->params['breadcrumbs'][] = ['label' => 'Recipe Ingredients', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="recipe-ingredient-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'recipe_id' => $model->recipe_id, 'ingre_id' => $model->ingre_id, 'measure_unit_id' => $model->measure_unit_id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'recipe_id' => $model->recipe_id, 'ingre_id' => $model->ingre_id, 'measure_unit_id' => $model->measure_unit_id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'recipe_id',
            'ingre_id',
            'measure_unit_id',
            'quantity',
        ],
    ]) ?>

</div>

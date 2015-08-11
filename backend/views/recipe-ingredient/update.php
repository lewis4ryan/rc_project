<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\RecipeIngredient */

$this->title = 'Update Recipe Ingredient: ' . ' ' . $model->recipe_id;
$this->params['breadcrumbs'][] = ['label' => 'Recipe Ingredients', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->recipe_id, 'url' => ['view', 'recipe_id' => $model->recipe_id, 'ingre_id' => $model->ingre_id, 'measure_unit_id' => $model->measure_unit_id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="recipe-ingredient-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>

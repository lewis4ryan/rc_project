<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\IngredientNutrition */

$this->title = 'Update Ingredient Nutrition: ' . ' ' . $model->ingre_id;
$this->params['breadcrumbs'][] = ['label' => 'Ingredient Nutritions', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->ingre_id, 'url' => ['view', 'ingre_id' => $model->ingre_id, 'nutri_id' => $model->nutri_id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="ingredient-nutrition-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>

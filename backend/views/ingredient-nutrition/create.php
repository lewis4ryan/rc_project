<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\IngredientNutrition */

$this->title = 'Create Ingredient Nutrition';
$this->params['breadcrumbs'][] = ['label' => 'Ingredient Nutritions', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ingredient-nutrition-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>

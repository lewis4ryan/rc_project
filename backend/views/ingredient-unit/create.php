<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\IngredientUnit */

$this->title = 'Create Ingredient Unit';
$this->params['breadcrumbs'][] = ['label' => 'Ingredient Units', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ingredient-unit-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>

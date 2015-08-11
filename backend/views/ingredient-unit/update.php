<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\IngredientUnit */

$this->title = 'Update Ingredient Unit: ' . ' ' . $model->ingre_id;
$this->params['breadcrumbs'][] = ['label' => 'Ingredient Units', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->ingre_id, 'url' => ['view', 'ingre_id' => $model->ingre_id, 'measureunit_id' => $model->measureunit_id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="ingredient-unit-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>

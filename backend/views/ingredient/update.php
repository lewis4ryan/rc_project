<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Ingredient */

$this->title = 'Cập nhật nguyên liệu : ' . ' ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Nguyên liệu', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Cập nhật';
?>
<div class="ingredient-update">

    <?= $this->render('_form', [
        'model' => $model,
        'ingredient_units' => $ingredient_units,
    ]) ?>

</div>

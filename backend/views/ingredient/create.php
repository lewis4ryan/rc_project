<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Ingredient */

$this->title = 'Tạo nguyên liệu';
$this->params['breadcrumbs'][] = ['label' => 'Nguyên liệu', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="ingredient-create">

    <?= $this->render('_form', [
        'model' => $model,
        'ingredient_units' => $ingredient_units,
    ]) ?>

</div>

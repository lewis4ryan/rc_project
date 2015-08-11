<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\IngredientNutrition */

$this->title = $model->ingre_id;
$this->params['breadcrumbs'][] = ['label' => 'Ingredient Nutritions', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ingredient-nutrition-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'ingre_id' => $model->ingre_id, 'nutri_id' => $model->nutri_id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'ingre_id' => $model->ingre_id, 'nutri_id' => $model->nutri_id], [
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
            'ingre_id',
            'nutri_id',
            'quantity',
        ],
    ]) ?>

</div>

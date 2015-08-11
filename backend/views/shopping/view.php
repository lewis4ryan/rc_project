<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Shopping */

$this->title = $model->user_id;
$this->params['breadcrumbs'][] = ['label' => 'Shoppings', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="shopping-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'user_id' => $model->user_id, 'ingre_id' => $model->ingre_id, 'measure_unit_id' => $model->measure_unit_id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'user_id' => $model->user_id, 'ingre_id' => $model->ingre_id, 'measure_unit_id' => $model->measure_unit_id], [
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
            'user_id',
            'ingre_id',
            'measure_unit_id',
            'quantity',
            'created',
            'updated',
        ],
    ]) ?>

</div>

<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Shopping */

$this->title = 'Update Shopping: ' . ' ' . $model->user_id;
$this->params['breadcrumbs'][] = ['label' => 'Shoppings', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->user_id, 'url' => ['view', 'user_id' => $model->user_id, 'ingre_id' => $model->ingre_id, 'measure_unit_id' => $model->measure_unit_id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="shopping-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>

<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Recipe */

$this->title = 'Cập nhật món ăn: ' . ' ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Món ăn', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Cập nhật';
?>
<div class="recipe-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>

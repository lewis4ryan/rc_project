<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Nutrition */

$this->title = 'Cập nhật dinh dưỡng: ' . ' ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Dinh dưỡng', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Cập nhật';
?>
<div class="nutrition-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>

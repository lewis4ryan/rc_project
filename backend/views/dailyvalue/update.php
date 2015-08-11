<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\DailyValue */

$this->title = 'Cập nhật: ' . ' ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Nhu cầu dinh dưỡng', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Cập nhật';
?>
<div class="daily-value-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>

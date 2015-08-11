<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Nutriunit */

$this->title = 'Cập nhật đơn vị dinh dưỡng: ' . ' ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Đơn vị dinh dưỡng', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Cập nhật';
?>
<div class="nutriunit-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>

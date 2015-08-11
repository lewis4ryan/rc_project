<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Measureunit */

$this->title = 'Cập nhật đơn vị : ' . ' ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Đơn vị đo lường', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Cập nhật';
?>
<div class="measureunit-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>

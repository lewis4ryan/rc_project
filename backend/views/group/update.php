<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Group */

$this->title = 'Cập nhật nhóm: ' . ' ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Nhóm nguyên liệu', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Câp nhật';
?>
<div class="group-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>

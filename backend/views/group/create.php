<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Group */

$this->title = 'Tạo nhóm';
$this->params['breadcrumbs'][] = ['label' => 'Nhóm nguyên liệu', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="group-create">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>

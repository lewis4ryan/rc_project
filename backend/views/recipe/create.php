<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Recipe */

$this->title = 'Tạo món ăn';
$this->params['breadcrumbs'][] = ['label' => 'Món ăn', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="recipe-create">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>

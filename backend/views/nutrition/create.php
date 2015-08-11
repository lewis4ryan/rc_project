<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Nutrition */

$this->title = 'Tạo mới dinh dưỡng';
$this->params['breadcrumbs'][] = ['label' => 'Dinh dưỡng', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="nutrition-create">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>

<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\DailyValue */

$this->title = 'Tạo mới';
$this->params['breadcrumbs'][] = ['label' => 'Nhu cầu dinh dưỡng', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="daily-value-create">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>

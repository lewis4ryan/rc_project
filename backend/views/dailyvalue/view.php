<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\DailyValue */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Nhu cầu dinh dưỡng', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="daily-value-view">

    <p>
        <?= Html::a('Cập nhật', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Xóa', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Bạn có muốn xóa?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'daily_value',
            'measure_unit',
        ],
    ]) ?>

</div>

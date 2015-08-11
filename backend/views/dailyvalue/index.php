<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\DailyValueSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Nhu cầu dinh dưỡng';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="daily-value-index">

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Tạo mới', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'daily_value',
            'measure_unit',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>

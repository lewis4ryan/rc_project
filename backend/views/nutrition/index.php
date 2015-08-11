<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
use dosamigos\datepicker\DatePicker;

/* @var $this yii\web\View */
/* @var $searchModel app\models\NutritionSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Dinh dưỡng';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="nutrition-index">

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Tạo mới', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?php Pjax::begin(); ?>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            [
                'label'=>$searchModel->getAttributeLabel('id'),
                'attribute'=>'id',
                'contentOptions'=>['style'=>'width: 90px;'], // <-- right here
            ],
            [
                'label'=>$searchModel->getAttributeLabel('name'),
                'attribute'=>'name',
                'format' => 'raw',
                'value'=>function($data) {
                        return '<code>'.$data->name.'</code>';
                    },
                'contentOptions'=>['style'=>'width: 200px;'] // <-- right here
            ],
            [
                'attribute' => 'unit_id',
                'label' => $searchModel->getAttributeLabel('unit_id'),
                'filter' => \app\models\Nutriunit::dropdown(),
                'value' => function($model, $index, $dataColumn) {
                        return $model->unit->name;
                },
                'contentOptions'=>['style'=>'width: 100px;'] // <-- right here
            ],
            [
                'label'=>$searchModel->getAttributeLabel('daily_value'),
                'attribute'=>'daily_value',
                'contentOptions'=>['style'=>'width: 50px;'] // <-- right here
            ],
            [
                'label'=>$searchModel->getAttributeLabel('created'),
                'attribute'=>'created',
                'format' => 'raw',
                'filter'=> DatePicker::widget([
                        'model' => $searchModel,
                        'attribute' => 'created',
                        'template' => '{addon}{input}',
                        'clientOptions' => [
                            'autoclose' => true,
                            'format' => 'yyyy-mm-dd',
                            'todayHighlight'=> true,
                            'clearBtn' => true,
                        ]
                    ]),
                'contentOptions'=>['style'=>'width: 200px;'] // <-- right here

            ],
            [
                'label'=>$searchModel->getAttributeLabel('updated'),
                'attribute'=>'updated',
                'format' => 'raw',
                'filter'=> DatePicker::widget([
                        'model' => $searchModel,
                        'attribute' => 'updated',
                        'template' => '{addon}{input}',
                        'clientOptions' => [
                            'autoclose' => true,
                            'format' => 'yyyy-mm-dd',
                            'todayHighlight'=> true,
                            'clearBtn' => true
                        ]
                    ]),
                'contentOptions'=>['style'=>'width: 200px;'] // <-- right here

            ],

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
    <?php Pjax::end(); ?>

</div>

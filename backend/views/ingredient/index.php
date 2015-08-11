<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
use dosamigos\datepicker\DatePicker;
/* @var $this yii\web\View */
/* @var $searchModel app\models\IngredientSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Nguyên liệu';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ingredient-index">

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

            /*[
                'label'=>$searchModel->getAttributeLabel('id'),
                'attribute'=>'id',
                'contentOptions'=>['style'=>'width: 90px;'], // <-- right here
            ],*/
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
                'attribute'=>'picture',
                'format' => 'raw',
                'value'=>function($data) {
                        return Html::img($data->imageurl,['width'=>50, 'height'=>50]);
                    },
                'contentOptions'=>['style'=>'width: 100px;'] // <-- right here

            ],

            //'description:ntext',
            [
                'label'=>$searchModel->getAttributeLabel('ingre_group_id'),
                'attribute'=>'ingre_group_id',
                'filter' => \app\models\Group::dropdown(),
                'value' => function($model, $index, $dataColumn) {
                        return $model->ingreGroup->name;
                    },
                'contentOptions'=>['style'=>'width: 200px;'] // <-- right here

            ],

            [
                'label'=>$searchModel->getAttributeLabel('is_vegetarian'),
                'attribute'=>'is_vegetarian',
                'filter' => \app\models\Ingredient::getVegetarianList(),
                'value' => function($model, $index, $dataColumn) {
                        return $model->getVegetarian($model->is_vegetarian);
                    },
                'contentOptions'=>['style'=>'width: 200px;'] // <-- right here

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

<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
use dosamigos\datepicker\DatePicker;
/* @var $this yii\web\View */
/* @var $searchModel app\models\RecipeSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Món ăn';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="recipe-index">

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

            //'id',
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
                'label'=>$searchModel->getAttributeLabel('difficulty'),
                'attribute'=>'difficulty',
                'filter' => \app\models\Recipe::getDifficultyList(),
                'value' => function($model, $index, $dataColumn) {
                        return $model->getDifficulty($model->difficulty);
                    },
                'contentOptions'=>['style'=>'width: 200px;'] // <-- right here

            ],
            [
                'label'=>$searchModel->getAttributeLabel('category_id'),
                'attribute'=>'category_id',
                'filter' => \app\models\Category::dropdown(),
                'value' => function($model, $index, $dataColumn) {
                        return $model->category->name;
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

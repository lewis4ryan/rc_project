<?php use yii\widgets\DetailView; ?>

<div class="panel widget panel-success">
    <div class="panel-heading">
        <h3 class="panel-title">
            <span class="menu-icon"> <i class="fa fa-info-circle"></i> </span>
            Thông tin chung
        </h3>
    </div>
    <div class="panel-body">

        <?= DetailView::widget([
            'model' => $model,
            'attributes' => [
                'name',
                [
                    'attribute' => 'is_vegetarian',
                    'value' => $model->getVegetarian($model->is_vegetarian),
                ],
                [
                    'attribute' => 'type',
                    'value' => $model->getType($model->type),
                ],
                [
                    'attribute'=>'ingre_group_id',
                    'value'=>$model->ingreGroup->name,
                ],
                [
                    'format' => ['image',['width'=>'100','height'=>'100']],
                    'attribute' => 'picture',
                    'value'=> \Yii::$app->request->baseUrl.'/upload/ingredient/'.$model->picture,
                ],
                'description:html',
                'created',
                'updated',
            ],
        ]) ?>
    </div>
</div>

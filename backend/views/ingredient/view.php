<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Ingredient */
$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Nguyên liệu', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ingredient-view">
    <p>
        <?= Html::a('Cập nhật', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Xóa', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Bạn có muốn xóa nguyên liệu này?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <!-- information -->
    <?= $this->render('_view_ingredient_details', [
        'model' => $model,
    ]) ?>

    <!-- nutrition -->
    <?= $this->render('_view_ingredient_nutrition', [
        'model' => $model,
    ]) ?>
</div>

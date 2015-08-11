<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Album */

$this->title = 'Update Album: ' . ' ' . $model->recipe_id;
$this->params['breadcrumbs'][] = ['label' => 'Albums', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->recipe_id, 'url' => ['view', 'recipe_id' => $model->recipe_id, 'image_id' => $model->image_id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="album-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>

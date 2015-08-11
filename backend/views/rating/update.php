<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Rating */

$this->title = 'Update Rating: ' . ' ' . $model->user_id;
$this->params['breadcrumbs'][] = ['label' => 'Ratings', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->user_id, 'url' => ['view', 'user_id' => $model->user_id, 'recipe_id' => $model->recipe_id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="rating-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>

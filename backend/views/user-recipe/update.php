<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\UserRecipe */

$this->title = 'Update User Recipe: ' . ' ' . $model->recipe_id;
$this->params['breadcrumbs'][] = ['label' => 'User Recipes', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->recipe_id, 'url' => ['view', 'recipe_id' => $model->recipe_id, 'user_id' => $model->user_id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="user-recipe-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>

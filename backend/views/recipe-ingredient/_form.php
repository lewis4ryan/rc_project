<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\RecipeIngredient */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="recipe-ingredient-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'recipe_id')->textInput() ?>

    <?= $form->field($model, 'ingre_id')->textInput() ?>

    <?= $form->field($model, 'measure_unit_id')->textInput() ?>

    <?= $form->field($model, 'quantity')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

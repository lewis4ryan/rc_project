<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\IngredientUnit */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="ingredient-unit-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'ingre_id')->textInput() ?>

    <?= $form->field($model, 'measureunit_id')->textInput() ?>

    <?= $form->field($model, 'weight')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

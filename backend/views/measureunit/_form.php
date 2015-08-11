<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

//use yii\bootstrap\ActiveForm;

//use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Measureunit */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="measureunit-form">

    <?php $form = ActiveForm::begin(
        [
            'layout' => 'horizontal',
            'fieldConfig' => [
                'template' => "{label}\n{beginWrapper}\n{input}\n{hint}\n{error}\n{endWrapper}",
                'horizontalCssClasses' => [
                    'label' => 'col-sm-2',
                    'offset' => 'col-sm-offset-4',
                    'wrapper' => 'col-sm-6',
                    'error' => '',
                    'hint' => '',
                ],
            ],
        ]
    ); ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'comment')->textInput(['maxlength' => true]) ?>

    <div class="form-group" style="padding-left: 40%">
        <?= Html::submitButton($model->isNewRecord ? 'Tạo mới' : 'Cập nhật', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

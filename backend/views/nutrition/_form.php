<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

//use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Nutrition */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="nutrition-form">

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
    <?= $form->errorSummary($model, ['header' => '']); ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'unit_id')->dropDownList(\yii\helpers\ArrayHelper::map(\app\models\Nutriunit::find()->all(),'id','name'),['prompt'=>'Chọn']) ?>

    <?= $form->field($model, 'daily_value')->textInput() ?>

    <?= $form->field($model, 'info')->textarea() ?>

    <div class="form-group" style="padding-left: 40%">
        <?= Html::submitButton($model->isNewRecord ? 'Tạo mới' : 'Cập nhật', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

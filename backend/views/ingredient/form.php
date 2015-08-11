<!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/jasny-bootstrap/3.1.3/css/jasny-bootstrap.min.css">
<link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/jasny-bootstrap/3.1.3/css/jasny-bootstrap.css">
<script src="https://code.jquery.com/jquery.js"></script
<script src="//cdnjs.cloudflare.com/ajax/libs/jasny-bootstrap/3.1.3/js/jasny-bootstrap.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/jasny-bootstrap/3.1.3/js/jasny-bootstrap.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/less.js/2.5.1/less.min.js"></script>

<?php

use yii\helpers\Html;
//use yii\widgets\ActiveForm;
use yii\bootstrap\ActiveForm;
use yii\helpers\BaseUrl;
//use dosamigos\fileinput\FileInput;
//use kartik\widgets\FileInput;

/* @var $this yii\web\View */
/* @var $model app\models\Ingredient */
/* @var $form yii\widgets\ActiveForm */

?>

<div class="ingredient-form">

    <?php $form = ActiveForm::begin([
        'options'=>[
            'enctype'=>'multipart/form-data',
        ],
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

    ]); ?>
    <?= $form->errorSummary($model, ['header' => '']); ?>

    <div class="panel widget panel-success">
        <div class="panel-heading">
            <h3 class="panel-title">
                <span class="menu-icon"> <i class="fa fa-map-marker"></i> </span>
                Thông tin chung
            </h3>
        </div>
        <div class="panel-body">
            <?= $this->render('_ingredient_form', [
                'model' => $model,
                'form' => $form
            ]) ?>
        </div>
    </div>

    <div class="panel widget panel-success">
        <div class="panel-heading">
            <h3 class="panel-title">
                <span class="menu-icon"> <i class="fa fa-map-marker"></i> </span>
                Chi tiết
            </h3>
        </div>
        <div class="panel-body">
            <?= $this->render('_ingredient_unit_form', [
                'model' => $ingredient_units,
                'form' => $form,
                'is_new_record' => $is_new_record,
            ]) ?>
        </div>
    </div>


    <div class="form-group" style="padding-left: 40%">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
<!--<script src="/admin/assets/fa8f5a2/jquery.js"></script>
<script src="/admin/assets/3316329e/js/jasny-bootstrap.js"></script>-->
<!-- Latest compiled and minified JavaScript -->

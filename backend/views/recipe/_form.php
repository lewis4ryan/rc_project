<script src="<?php echo \Yii::$app->request->baseUrl?>/assets/80cfded4/jquery.js"></script>
<script src="<?php echo \Yii::$app->request->baseUrl?>/extension/jquery-ui-1.11.4.custom/jquery-ui.js"></script>
<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
//use yii\bootstrap\ActiveForm;
use yii\bootstrap\Modal;
/* @var $this yii\web\View */
/* @var $model app\models\Recipe */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="recipe-form">

    <?php $form = ActiveForm::begin(); ?>

    <div class="row">
        <div class="col-md-6">
            <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

            <?= $form->field($model, 'description')->textarea(['rows' => 6]) ?>
        </div>
        <div class="col-md-6">
            <div class="row">
                <div class="col-md-4"><b>Độ khó</b><span style="color: red">*</span></div>
                <div class="col-md-4">
                    <?= $form->field($model, 'difficulty',['template' => '{input}{error}{hint}'])->dropDownList($model->getDifficultyList(),['prompt'=>'-- Chọn --']) ?>
                </div>
            </div>
            <div class="row">
                <div class="col-md-4"><b>Khẩu phần</b><span style="color: red">*</span></div>
                <div class="col-md-4">
                    <?= $form->field($model, 'serving_size', ['template' => '{input}{error}{hint}'])->dropDownList($model->getServingList(),['prompt'=>'-- Chọn --']) ?>
                </div>
            </div>
            <div class="row">
                <div class="col-md-4"><b>Ngân sách</b></div>
                <div class="col-md-4">
                    <?= $form->field($model, 'budget', ['template' => '{input}{error}{hint}'])
                        ->textInput(['maxlength' => true, 'placeholder'=>'50000', 'type'=>'number', 'min'=>0])
                        ->hint('Đơn vị: VNĐ') ?>
                </div>
            </div>
            <div class="row">
                <div class="col-md-4"><b>Thời gian chuẩn bị</b><span style="color: red">*</span></div>
                <div class="col-md-3">
                    <?= $form->field($model, 'prepare_time_hour',
                        ['template' => '{input}{error}{hint}']
                    )->textInput(['type'=>'number', 'min'=>0, 'placeholder'=>'giờ']); ?>
                </div>
                <div class="col-md-3">
                    <?= $form->field($model, 'prepare_time_minute',
                        [
                            'template' => '{input}{error}{hint}'
                        ]
                    )->textInput(['type'=>'number', 'min'=>0, 'placeholder'=>'phút']); ?>
                </div>
            </div>
            <div class="row">
                <div class="col-md-4"><b>Thời gian nấu</b><span style="color: red">*</span></div>
                <div class="col-md-3">
                    <?= $form->field($model, 'duration_hour',
                        [
                            'template' => '{input}{error}{hint}'
                        ]
                    )->textInput(['type'=>'number', 'placeholder'=>'giờ']); ?>
                </div>
                <div class="col-md-3">
                    <?= $form->field($model, 'duration_minute',
                        [
                            'template' => '{input}{error}{hint}'
                        ]
                    )->textInput(['type'=>'number', 'placeholder'=>'phút']); ?>
                </div>
            </div>

            <div class="row">
                <div class="col-md-4"><b>Quốc gia</b><span style="color: red">*</span></div>
                <div class="col-md-4">
                    <?= $form->field($model, 'country_id', ['template' => '{input}{error}{hint}'])->dropDownList(\app\models\Country::dropdown(),['prompt'=>'-- Chọn --']) ?>
                </div>
            </div>

            <div class="row">
                <div class="col-md-4"><b>Thể loại</b><span style="color: red">*</span></div>
                <div class="col-md-4">
                    <?= $form->field($model, 'category_id', ['template' => '{input}{error}{hint}'])->dropDownList(\app\models\Category::dropdown(),['prompt'=>'-- Chọn --']) ?>
                </div>
            </div>

        </div>
    </div>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Tạo mới' : 'Cập nhật', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>
</div>

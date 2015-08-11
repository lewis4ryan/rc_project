<script src="<?php echo \Yii::$app->request->baseUrl?>/assets/80cfded4/jquery.js"></script>
<script src="<?php echo \Yii::$app->request->baseUrl?>/extension/jquery-ui-1.11.4.custom/jquery-ui.js"></script>
<link rel="stylesheet" href="<?php echo \Yii::$app->request->baseUrl?>/extension/jasny/jasny-bootstrap.min.css" type="text/css"/>
<link rel="stylesheet" href="<?php echo \Yii::$app->request->baseUrl?>/extension/jasny/jasny-bootstrap.css" type="text/css"/>
<script src="<?php echo \Yii::$app->request->baseUrl?>/extension/jasny/jasny-bootstrap.js"></script>
<script src="<?php echo \Yii::$app->request->baseUrl?>/extension/jasny/jasny-bootstrap.min.js"></script>

<?php
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\bootstrap\Modal;
//use yii\widgets\ActiveForm;
//use yii\helpers\BaseUrl;
//use dosamigos\fileinput\FileInput;
//use kartik\widgets\FileInput;

/* @var $this yii\web\View */
/* @var $model app\models\Ingredient */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="ingredient-form">
    <div class="alert alert-info fade in" role="alert">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
        <strong>Mẹo! trước khi tạo nguyên liệu bạn nên:</strong><br>
        <ul>
            <li>
                Tìm kiếm kỹ nguyên liệu tại đây:... Xem tất cả nguyên liệu tương tự nhau để tránh bị trùng lặp.<br>
                Ví dụ: Tìm các từ khóa: cá lóc, cá quả, cá tràu ...
            </li>
            <li>
                Ban đã có một hình ảnh cho nguyên liệu
            </li>
            <li>
                Hãy chắc chắn bạn đã có đầy đủ thông tin chi tiết về nguyên liệu
            </li>
            <li>
                Đảm bảo dữ liệu chính xác cho các đơn vị và dinh dưỡng cần thiết
            </li>
        </ul>
    </div>
    <?php $form = ActiveForm::begin([
        'options'=>[
            'enctype'=>'multipart/form-data',
        ],
        'layout' => 'horizontal',
        'fieldConfig' => [
            'template' => "{label}\n{beginWrapper}\n{input}\n{error}\n{endWrapper}\n{hint}",
            'horizontalCssClasses' => [
                'label' => 'col-sm-3',
                'offset' => 'col-sm-offset-3',
                'wrapper' => 'col-sm-6',
                'error' => '',
                'hint' => 'col-sm-3',
            ],
        ],

    ]); ?>
    <?= $form->errorSummary($model, ['header' => '']); ?>
    <!-- information -->
    <div class="panel widget panel-success">
        <div class="panel-heading">
            <h3 class="panel-title">
                <span class="menu-icon"> <i class="fa fa-info-circle"></i> </span>
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
    <!-- Units -->
    <div class="panel widget panel-success">
        <div class="panel-heading">
            <h3 class="panel-title">
                <span class="menu-icon"> <i class="glyphicon glyphicon-th-list"></i> </span>
                Đơn vị: <input type="text" id="search_ingre_unit_input" placeholder="Tìm kiếm">

            </h3>
        </div>
        <div class="panel-body">
            <?= $this->render('_ingredient_unit_form', [
                'model' => $model,
                'ingredient_units' => $ingredient_units,
                'form' => $form,
            ]) ?>
        </div>
    </div>

    <!-- nutrition -->
    <div class="panel widget panel-success">
        <div class="panel-heading">
            <h3 class="panel-title">
                <span class="menu-icon"> <i class="fa fa-calculator"></i> </span>
                Thành phần dinh dưỡng (mỗi 100gam):
            </h3>
        </div>
        <div class="panel-body">
            <?= $this->render('_ingredient_nutrition_form', [
                'model' => $model,
                'form' => $form,
            ]) ?>
        </div>
    </div>

    <div class="form-group" style="padding-left: 40%">
        <?= Html::submitButton($model->isNewRecord ? 'Tạo mới' : 'Cập nhật', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>


<?php
Modal::begin([
    'id' => 'model_import',
    'header' => '<h2>Chọn file</h2>',
    'toggleButton' => ['label' => 'Import từ file'],
]);
?>

<form method="post" id="import_nutrition" action="import" class="form-horizontal" enctype="multipart/form-data">
    <div class="fileinput fileinput-new" data-provides="fileinput">
        <span class="btn btn-default btn-file"><span class="fileinput-new">Chọn file</span><span class="fileinput-exists">Change</span><input required type="file" accept="text/plain" name="nutrition_txt"></span>
        <span class="fileinput-filename"></span>
        <a href="#" class="close fileinput-exists" data-dismiss="fileinput" style="float: none">&times;</a>
    </div>
    <button type="submit" id="import_btn" class="btn btn-success">Import</button>
</form>
<?php Modal::end(); ?>

<script type="text/javascript">
    $(document).ready(function () {
        var form_id = '#import_nutrition';
        $('#import_btn').click(function (e) {
            $(this).html('<i id="save-spinner" class="fa fa-spinner fa-spin append-icon">');
        });

        $(form_id).submit(function (e) {
            $('#import_btn').html('<i id="save-spinner" class="fa fa-spinner fa-spin append-icon">');
            var formObj = $(this);
            var formURL = formObj.attr("action");
            var formData = new FormData(this);
            $.ajax({
                url: formURL,
                type: 'POST',
                data: formData,
                mimeType: "multipart/form-data",
                contentType: false,
                cache: false,
                processData: false,
                success: function (data, textStatus, jqXHR) {
                    nutrition = $.parseJSON(data);
                    $.each(nutrition, function(key, value) {
                        /// do stuff
                        $('#ingredient-'+key).val(value);
                    });

                    $('#model_import').modal('hide');
                },
                error: function (jqXHR, textStatus, errorThrown) {
                }
            });
            $('#import_btn').html('Import');
            e.preventDefault();
        });
    })
</script>
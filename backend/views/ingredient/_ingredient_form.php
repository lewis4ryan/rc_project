<?php use dosamigos\ckeditor\CKEditor;?>
<?= $form->field($model, 'name')->textInput(['maxlength' => true])
    ->hint('<a href="javascript:void(0)" data-trigger="hover" data-toggle="popover" title="Ghi chú" data-content="Tên nguyên liệu là không được trùng lặp. Bạn nên kiểm tra tên nguyên liệu trước khi tạo." data-delay="200"><i class="fa fa-2x fa-info-circle"></i></a>')?>
<?= $form->field($model, 'is_vegetarian')->inline()->radioList($model->getVegetarianList()) ?>
<?= $form->field($model, 'type')->dropDownList($model->getTypeList(),['prompt'=>'-- Chọn --']) ?>
<?= $form->field($model, 'ingre_group_id')->dropDownList(\app\models\Group::dropdown(),['prompt'=>'-- Chọn --']) ?>

<div class="form-group field-ingredient-picture required">
    <label class="control-label col-sm-3" for="ingredient-picture">Hình ảnh</label>
    <?php if ($model->isNewRecord == '0') {
        if($model->picture){
            $path = \Yii::$app->request->baseUrl.'/upload/ingredient/'.$model->picture;

        }else{
            $path = \Yii::$app->request->baseUrl.'/upload/default/default-ingredient.jpg';
        }
        ?>
        <div class="col-sm-6">
            <div class="fileinput fileinput-new" data-provides="fileinput">
                <div class="fileinput-new thumbnail" style="width: 200px; height: auto;">
                    <img src="<?php echo $path;?>" style="max-height: 190px;">

                </div>
                <div class="fileinput-preview fileinput-exists thumbnail"
                     style="max-width: 200px; max-height: 150px;"></div>
                <div>
                        <span class="btn btn-default btn-file">
                            <span><?php echo 'Change'; ?></span>
                            <input size="60" maxlength="255" name="Ingredient[picture]" id="ingredient-picture" type="file" accept="image/*" class="form-control">
                        </span>
                    <a href="#" class="btn btn-default "
                       data-dismiss="fileinput"><?php echo 'Remove'; ?></a>
                </div>
            </div>
        </div>

    <?php } else {
        $path = \Yii::$app->request->baseUrl.'/upload/default/default-ingredient.jpg';
        ?>
        <div class="col-sm-6">
            <div class="fileinput fileinput-new" data-provides="fileinput">
                <div class="fileinput-new thumbnail" style="width: 200px; height: 200px;">
                    <!--                    <img src="https://d1luk0418egahw.cloudfront.net/static/images/guide/NoImage_800x600.jpg">-->
                    <img src="<?php echo $path?>">

                </div>
                <div class="fileinput-preview fileinput-exists thumbnail" style="max-width: 200px; max-height: 200px;">
                </div>

                <div>
                        <span class="btn btn-default btn-file">
                            <span class="fileinput-new"><?php echo 'Select image'; ?></span>
                            <span class="fileinput-exists"><?php echo 'Change'; ?></span>
                            <!--<input id="ingredient-picture" type="hidden" value="" name="Ingredient[picture]">-->
                            <input required size="60" maxlength="255" name="Ingredient[picture]" id="ingredient-picture" type="file" accept="image/*" class="form-control">
                            <?php //echo $form->field($model, 'picture')->fileInput(['maxlength' => true]) ?>

                        </span>
                    <a href="#" class="btn btn-default fileinput-exists" data-dismiss="fileinput"><?php echo 'Remove'; ?></a>
                </div>
            </div>
        </div>
    <?php } ?>
    <div class="help-block"></div>
</div>

<?= $form->field($model, 'description')->textarea(['rows' => 6])->widget(CKEditor::className(), [
    'options' => ['rows' => 6],
    'preset' => 'basic'
]) ?>

<script type="text/javascript">
    $(document).ready(function(){
        $('[data-toggle="popover"]').popover();
    });
</script>
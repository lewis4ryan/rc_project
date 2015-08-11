    <div class="col-sm-6">
        <div class="panel panel-danger">
            <div class="panel-heading">
                <h3 class="panel-title">
                    <span class="menu-icon"> <i class="fa fa-star"></i> </span>
                    Thông tin Calorie
                </h3>
            </div>
            <div class="panel-body">
                <?= $form->field($model, 'calories')->textInput(['maxlength' => true, 'class'=>'validate[custom[number],min[0]] col-sm-11'])->hint('Kcal')?>
                <hr>
                <?= $form->field($model, 'from_carb')->textInput(['maxlength' => true, 'class'=>'validate[custom[number],min[0]] col-sm-11'])->hint('Kcal')?>
                <?= $form->field($model, 'from_fat')->textInput(['maxlength' => true, 'class'=>'validate[custom[number],min[0]] col-sm-11'])->hint('Kcal')?>
                <?= $form->field($model, 'from_protein')->textInput(['maxlength' => true, 'class'=>'validate[custom[number],min[0]] col-sm-11'])->hint('Kcal')?>
                <?= $form->field($model, 'from_alcohol')->textInput(['maxlength' => true, 'class'=>'validate[custom[number],min[0]] col-sm-11'])->hint('Kcal')?>
            </div>
        </div>

        <div class="panel panel-danger">
            <div class="panel-heading">
                <h3 class="panel-title">
                    <span class="menu-icon"> <i class="glyphicon glyphicon-ruble"></i> </span>
                    Protein
                </h3>
            </div>
            <div class="panel-body">
                <?= $form->field($model, 'protein')->textInput(['maxlength' => true, 'class'=>'validate[custom[number],min[0]] col-sm-11'])->hint('gam')?>
            </div>
        </div>

        <div class="panel panel-danger">
            <div class="panel-heading">
                <h3 class="panel-title">
                    <span class="menu-icon"> <i class="fa fa-check-circle"></i> </span>
                    Fat
                </h3>
            </div>
            <div class="panel-body">
                <?= $form->field($model, 'fat')->textInput(['maxlength' => true, 'class'=>'validate[custom[number],min[0]] col-sm-11'])->hint('gam')?>
                <hr>
                <?= $form->field($model, 'saturated_fat')->textInput(['maxlength' => true, 'class'=>'validate[custom[number],min[0]] col-sm-11'])->hint('gam')?>

                <?= $form->field($model, 'trans_fat')->textInput(['maxlength' => true, 'class'=>'validate[custom[number],min[0]] col-sm-11'])->hint('gam')?>
                <?= $form->field($model, 'trans_monoenoic')->textInput(['maxlength' => true, 'class'=>'validate[custom[number],min[0]] col-sm-11'])->hint('gam')?>
                <?= $form->field($model, 'trans_polyenoic')->textInput(['maxlength' => true, 'class'=>'validate[custom[number],min[0]] col-sm-11'])->hint('gam')?>

                <?= $form->field($model, 'monounsaturated')->textInput(['maxlength' => true, 'class'=>'validate[custom[number],min[0]] col-sm-11'])->hint('gam')?>
                <?= $form->field($model, 'polyunsaturated')->textInput(['maxlength' => true, 'class'=>'validate[custom[number],min[0]] col-sm-11'])->hint('gam')?>

                <?= $form->field($model, 'omega_3')->textInput(['maxlength' => true, 'class'=>'validate[custom[number],min[0]] col-sm-11'])->hint('mg')?>
                <?= $form->field($model, 'omega_6')->textInput(['maxlength' => true, 'class'=>'validate[custom[number],min[0]] col-sm-11'])->hint('mg')?>
            </div>
        </div>
    </div>


    <div class="col-sm-6">
        <div class="panel panel-danger">
            <div class="panel-heading">
                <h3 class="panel-title">
                    <span class="menu-icon"> <i class="glyphicon glyphicon-copyright-mark"></i> </span>
                    Carbohydrates
                </h3>
            </div>
            <div class="panel-body">
                <?= $form->field($model, 'carbohydrates')->textInput(['maxlength' => true, 'class'=>'validate[custom[number],min[0]] col-sm-11'])->hint('gam')?>
                <hr>
                <?= $form->field($model, 'dietary_fiber')->textInput(['maxlength' => true, 'class'=>'validate[custom[number],min[0]] col-sm-11'])->hint('gam')?>
                <?= $form->field($model, 'starch')->textInput(['maxlength' => true, 'class'=>'validate[custom[number],min[0]] col-sm-11'])->hint('gam')?>
                <?= $form->field($model, 'sugar')->textInput(['maxlength' => true, 'class'=>'validate[custom[number],min[0]] col-sm-11'])->hint('gam')?>

            </div>
        </div>

        <div class="panel panel-danger">
            <div class="panel-heading">
                <h3 class="panel-title">
                    <span class="menu-icon"> <i class="fa fa-buysellads"></i> </span>
                    Vitamin/Khoáng chất
                </h3>
            </div>
            <div class="panel-body">
                <?= $form->field($model, 'calcium')->textInput(['maxlength' => true, 'class'=>'validate[custom[number],min[0]] col-sm-11'])->hint('mg')?>

                <?= $form->field($model, 'vitamin_A')->textInput(['maxlength' => true, 'class'=>'validate[custom[number],min[0]] col-sm-11'])->hint('IU')?>

                <?= $form->field($model, 'vitamin_C')->textInput(['maxlength' => true, 'class'=>'validate[custom[number],min[0]] col-sm-11'])->hint('mg')?>

                <?= $form->field($model, 'vitamin_D')->textInput(['maxlength' => true, 'class'=>'validate[custom[number],min[0]] col-sm-11'])->hint('IU')?>

                <?= $form->field($model, 'iron')->textInput(['maxlength' => true, 'class'=>'validate[custom[number],min[0]] col-sm-11'])->hint('mg')?>

                <?= $form->field($model, 'zinc')->textInput(['maxlength' => true, 'class'=>'validate[custom[number],min[0]] col-sm-11'])->hint('mg')?>

                <?= $form->field($model, 'sodium')->textInput(['maxlength' => true, 'class'=>'validate[custom[number],min[0]] col-sm-11'])->hint('mg')?>

                <?= $form->field($model, 'magnesium')->textInput(['maxlength' => true, 'class'=>'validate[custom[number],min[0]] col-sm-11'])->hint('mg')?>

                <?= $form->field($model, 'thiamin')->textInput(['maxlength' => true, 'class'=>'validate[custom[number],min[0]] col-sm-11'])->hint('mg')?>

                <?= $form->field($model, 'phosphorus')->textInput(['maxlength' => true, 'class'=>'validate[custom[number],min[0]] col-sm-11'])->hint('mg')?>

            </div>
        </div>
    </div>

    <div class="col-sm-6">
        <div class="panel panel-danger">
            <div class="panel-heading">
                <h3 class="panel-title">
                    <span class="menu-icon"> <i class="fa fa-chevron-circle-up"></i> </span>
                    Khác
                </h3>
            </div>
            <div class="panel-body">
                <?= $form->field($model, 'caffeine')->textInput(['maxlength' => true, 'class'=>'validate[custom[number],min[0]] col-sm-11'])->hint('mg')?>
                <?= $form->field($model, 'cholesterol')->textInput(['maxlength' => true, 'class'=>'validate[custom[number],min[0]] col-sm-11'])->hint('mg')?>

                <?= $form->field($model, 'water')->textInput(['maxlength' => true, 'class'=>'validate[custom[number],min[0]] col-sm-11'])->hint('gam')?>
                <?= $form->field($model, 'alcohol')->textInput(['maxlength' => true, 'class'=>'validate[custom[number],min[0]] col-sm-11'])->hint('gam')?>

            </div>
        </div>
    </div>

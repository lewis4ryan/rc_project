<!-- nutrition -->
<div class="panel widget panel-success">
<div class="panel-heading">
    <h3 class="panel-title">
        <span class="menu-icon"> <i class="fa fa-calculator"></i> </span>
        Thành phần dinh dưỡng (mỗi 100gam):
    </h3>
</div>
<div class="panel-body">
<div class="row">
    <div class="col-md-6">
        <div class="panel-heading">
            <h3 class="panel-title">
                <span class="menu-icon"> <i class="fa fa-star"></i> </span>
                Tỷ lệ calorie
            </h3>
        </div>
        <div class="panel-body">
            Carbohydrat
            <div class="progress">
                <div class="progress-bar progress-bar-success progress-bar-striped" role="progressbar"
                     aria-valuenow="<?php echo $model->rate_carbs_in_calorie()?>" aria-valuemin="0" aria-valuemax="100" style="width:<?php echo $model->rate_carbs_in_calorie()?>%">
                    <?php echo $model->rate_carbs_in_calorie();?> %
                </div>
            </div>
            Protein

            <div class="progress">
                <div class="progress-bar progress-bar-success progress-bar-info" role="progressbar"
                     aria-valuenow="<?php echo $model->rate_protein_in_calorie()?>" aria-valuemin="0" aria-valuemax="100" style="width:<?php echo $model->rate_protein_in_calorie()?>%">
                    <?php echo $model->rate_protein_in_calorie()?> %
                </div>
            </div>
            Fat

            <div class="progress">
                <div class="progress-bar progress-bar-success progress-bar-warning" role="progressbar"
                     aria-valuenow="<?php echo $model->rate_fat_in_calorie()?>" aria-valuemin="0" aria-valuemax="100" style="width:<?php echo $model->rate_fat_in_calorie()?>%">
                    <?php echo $model->rate_fat_in_calorie()?> %
                </div>
            </div>
            Alcohol
            <div class="progress">
                <div class="progress-bar progress-bar-success progress-bar-danger" role="progressbar"
                     aria-valuenow="<?php echo $model->rate_alcohol_in_calorie()?>" aria-valuemin="0" aria-valuemax="100" style="width:<?php echo $model->rate_alcohol_in_calorie()?>%">
                    <?php echo $model->rate_alcohol_in_calorie()?> %
                </div>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-sm-6">
        <?php if(isset($model->opinion()['GOOD']) && count($model->opinion()['GOOD']) >0){ ?>
            <ul class="list-group">
                <li class="list-group-item list-group-item-success">Ưu điểm</li>
                <?php foreach($model->opinion()['GOOD'] as $opinion){
                    echo '<li class="list-group-item">'.$opinion.'</li>';
                }?>
            </ul>
        <?php } ?>
    </div>
    <div class="col-sm-6">
        <?php if(isset($model->opinion()['BAD']) && count($model->opinion()['BAD']) >0){ ?>
            <ul class="list-group">
                <li class="list-group-item list-group-item-success">Nhược điểm</li>
                <?php foreach($model->opinion()['BAD'] as $opinion){
                    echo '<li class="list-group-item">'.$opinion.'</li>';
                }?>
            </ul>
        <?php } ?>
    </div>
</div>

<div class="col-sm-6">
    <div class="panel panel-danger">
        <div class="panel-heading">
            <h3 class="panel-title">
                <span class="menu-icon"> <i class="fa fa-star"></i> </span>
                Thông tin Calorie
            </h3>
        </div>
        <div class="panel-body">
            <table class="table table-striped table-hover">
                <tbody>
                <tr style="color: #ff0000">
                    <td><label><?php echo $model->getAttributeLabel('calories')?></label></td>
                    <td><label><?php echo $model->calories?></label></td>
                    <td><label>Kcal</label></td>
                </tr>
                <tr>
                    <td><label><?php echo $model->getAttributeLabel('from_carb')?></label></td>
                    <td><label><?php echo $model->from_carb?></label></td>
                    <td><label>Kcal</label></td>
                </tr>
                <tr>
                    <td><label><?php echo $model->getAttributeLabel('from_fat')?></label></td>
                    <td><label><?php echo $model->from_fat?></label></td>
                    <td><label>Kcal</label></td>
                </tr>
                <tr>
                    <td><label><?php echo $model->getAttributeLabel('from_protein')?></label></td>
                    <td><label><?php echo $model->from_protein?></label></td>
                    <td><label>Kcal</label></td>
                </tr>
                <tr>
                    <td><label><?php echo $model->getAttributeLabel('from_alcohol')?></label></td>
                    <td><label><?php echo $model->from_alcohol?></label></td>
                    <td><label>Kcal</label></td>
                </tr>
                </tbody>
            </table>
        </div>
    </div>
    <!--protein-->
    <div class="panel panel-danger">
        <div class="panel-heading">
            <h3 class="panel-title">
                <span class="menu-icon"> <i class="glyphicon glyphicon-ruble"></i> </span>
                Protein
            </h3>
        </div>
        <div class="panel-body">
            <table class="table table-striped table-hover">
                <tbody>
                <tr style="color: #ff0000">
                    <td><label><?php echo $model->getAttributeLabel('protein')?></label></td>
                    <td><label><?php echo $model->protein?></label></td>
                    <td><label>gam</label></td>
                </tr>
                </tbody>
            </table>
        </div>
    </div>
    <!--fat-->
    <div class="panel panel-danger">
        <div class="panel-heading">
            <h3 class="panel-title">
                <span class="menu-icon"> <i class="fa fa-check-circle"></i> </span>
                Fat
            </h3>
        </div>
        <div class="panel-body">
            <table class="table table-striped table-hover">
                <tbody>
                <tr style="color: #ff0000">
                    <td><label><?php echo $model->getAttributeLabel('fat')?></label></td>
                    <td><label><?php echo $model->fat?></label></td>
                    <td><label>gam</label></td>
                </tr>
                <tr>
                    <td><label><?php echo $model->getAttributeLabel('saturated_fat')?></label></td>
                    <td><label><?php echo $model->saturated_fat?></label></td>
                    <td><label>gam</label></td>
                </tr>
                <tr>
                    <td><label><?php echo $model->getAttributeLabel('trans_fat')?></label></td>
                    <td><label><?php echo $model->trans_fat?></label></td>
                    <td><label>gam</label></td>
                </tr>
                <tr>
                    <td><label><?php echo $model->getAttributeLabel('trans_monoenoic')?></label></td>
                    <td><label><?php echo $model->trans_monoenoic?></label></td>
                    <td><label>gam</label></td>
                </tr>
                <tr>
                    <td><label><?php echo $model->getAttributeLabel('trans_polyenoic')?></label></td>
                    <td><label><?php echo $model->trans_polyenoic?></label></td>
                    <td><label>gam</label></td>
                </tr>
                <tr>
                    <td><label><?php echo $model->getAttributeLabel('monounsaturated')?></label></td>
                    <td><label><?php echo $model->monounsaturated?></label></td>
                    <td><label>gam</label></td>
                </tr>
                <tr>
                    <td><label><?php echo $model->getAttributeLabel('polyunsaturated')?></label></td>
                    <td><label><?php echo $model->polyunsaturated?></label></td>
                    <td><label>gam</label></td>
                </tr>
                <tr>
                    <td><label><?php echo $model->getAttributeLabel('omega_3')?></label></td>
                    <td><label><?php echo $model->omega_3?></label></td>
                    <td><label>mg</label></td>
                </tr>
                <tr>
                    <td><label><?php echo $model->getAttributeLabel('omega_6')?></label></td>
                    <td><label><?php echo $model->omega_6?></label></td>
                    <td><label>mg</label></td>
                </tr>
                </tbody>
            </table>
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
            <table class="table table-striped table-hover">
                <tbody>
                <tr style="color: #ff0000">
                    <td><label><?php echo $model->getAttributeLabel('carbohydrates')?></label></td>
                    <td><label><?php echo $model->carbohydrates?></label></td>
                    <td><label>gam</label></td>
                </tr>
                <tr>
                    <td><label><?php echo $model->getAttributeLabel('dietary_fiber')?></label></td>
                    <td><label><?php echo $model->dietary_fiber?></label></td>
                    <td><label>gam</label></td>
                </tr>
                <tr>
                    <td><label><?php echo $model->getAttributeLabel('starch')?></label></td>
                    <td><label><?php echo $model->starch?></label></td>
                    <td><label>gam</label></td>
                </tr>
                <tr>
                    <td><label><?php echo $model->getAttributeLabel('sugar')?></label></td>
                    <td><label><?php echo $model->sugar?></label></td>
                    <td><label>gam</label></td>
                </tr>
                </tbody>
            </table>
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
            <table class="table table-striped table-hover">
                <tbody>
                <tr>
                    <td><label><?php echo $model->getAttributeLabel('calcium')?></label></td>
                    <td><label><?php echo $model->calcium?></label></td>
                    <td><label>mg</label></td>
                </tr>
                <tr>
                    <td><label><?php echo $model->getAttributeLabel('vitamin_A')?></label></td>
                    <td><label><?php echo $model->vitamin_A?></label></td>
                    <td><label>IU</label></td>
                </tr>
                <tr>
                    <td><label><?php echo $model->getAttributeLabel('vitamin_C')?></label></td>
                    <td><label><?php echo $model->vitamin_C?></label></td>
                    <td><label>mg</label></td>
                </tr>
                <tr>
                    <td><label><?php echo $model->getAttributeLabel('vitamin_D')?></label></td>
                    <td><label><?php echo $model->vitamin_D?></label></td>
                    <td><label>IU</label></td>
                </tr>
                <tr>
                    <td><label><?php echo $model->getAttributeLabel('iron')?></label></td>
                    <td><label><?php echo $model->iron?></label></td>
                    <td><label>mg</label></td>
                </tr>
                <tr>
                    <td><label><?php echo $model->getAttributeLabel('zinc')?></label></td>
                    <td><label><?php echo $model->zinc?></label></td>
                    <td><label>mg</label></td>
                </tr>
                <tr>
                    <td><label><?php echo $model->getAttributeLabel('sodium')?></label></td>
                    <td><label><?php echo $model->sodium?></label></td>
                    <td><label>mg</label></td>
                </tr>
                <tr>
                    <td><label><?php echo $model->getAttributeLabel('magnesium')?></label></td>
                    <td><label><?php echo $model->magnesium?></label></td>
                    <td><label>mg</label></td>
                </tr>
                <tr>
                    <td><label><?php echo $model->getAttributeLabel('thiamin')?></label></td>
                    <td><label><?php echo $model->thiamin?></label></td>
                    <td><label>mg</label></td>
                </tr>
                <tr>
                    <td><label><?php echo $model->getAttributeLabel('phosphorus')?></label></td>
                    <td><label><?php echo $model->phosphorus?></label></td>
                    <td><label>mg</label></td>
                </tr>
                </tbody>
            </table>
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
            <table class="table table-striped table-hover">
                <tbody>
                <tr>
                    <td><label><?php echo $model->getAttributeLabel('caffeine')?></label></td>
                    <td><label><?php echo $model->caffeine?></label></td>
                    <td><label>mg</label></td>
                </tr>
                <tr>
                    <td><label><?php echo $model->getAttributeLabel('cholesterol')?></label></td>
                    <td><label><?php echo $model->cholesterol?></label></td>
                    <td><label>mg</label></td>
                </tr>
                <tr>
                    <td><label><?php echo $model->getAttributeLabel('water')?></label></td>
                    <td><label><?php echo $model->water?></label></td>
                    <td><label>gam</label></td>
                </tr>
                <tr>
                    <td><label><?php echo $model->getAttributeLabel('alcohol')?></label></td>
                    <td><label><?php echo $model->alcohol?></label></td>
                    <td><label>gam</label></td>
                </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>
</div>
</div>
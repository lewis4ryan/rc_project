<?php
$tabs = array(
    'Category', 'Basic data and texts', 'Key figures and equipment', 'Images and files', 'Publish'
);
?>
<div class="form-wizard immo">
    <ul class="nav nav-pills nav-justified">
        <?php
        if($model->isNewRecord){
            foreach ($tabs as $i=>$tab){
                echo '<li'.($i<$step?' class="active"':'').''.($i+1>$step?' class="disabled"':'').'><a href="'.($i+1<=$step?'?step='.($i+1).($model->id?'&id='.$model->id:''):'javascript:void(0)').'">
            <div class="menu-icon"> '.($i+1).' </div>
            '.$tab.' </a></li>';
            }
        }else{
            //update
            foreach ($tabs as $i=>$tab){
                echo '<li class="active">'.'<a href="?step='.($i+1).'&id='.$model->id.'">'.
                    '<div class="menu-icon"> '.($i+1).' </div>'.$tab.' </a></li>';
            }
        }
        ?>
    </ul>
</div>
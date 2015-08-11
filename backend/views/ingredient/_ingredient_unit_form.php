<div class="panel-body">
    <div id="ingre_unit_input" style="min-height: 50px">

    </div>
</div>
<hr>
<br>
<div id="list_unit_selected" style="min-height: 50px">
    <?php
    $unit_array = array();
    if(!$model->isNewRecord){
        foreach($ingredient_units as $ingredient_unit){
            echo '<div class="form-group field-ingredientunit-weight required col-sm-6">';
            echo '<div class="col-sm-3">';
            echo '<input type="hidden" name="IngredientUnit['.$ingredient_unit->measureunit_id.'][measureunit_id]" value='.$ingredient_unit->measureunit_id.'>';
            echo '<a class="unit_item_selected" value='.$ingredient_unit->measureunit_id.' label="'.$ingredient_unit->measureunit->name.'" href=javascript:void(0)><i class="fa fa-trash-o" style="color: red"> </i>'.$ingredient_unit->measureunit->name.'</a>';
            echo '</div>';
            echo '<input class="validate[required,custom[number],min[1]]" name="IngredientUnit['.$ingredient_unit->measureunit_id.'][weight] id="ingredientunit-weight" placeholder="trọng lượng ..." value="'.$ingredient_unit->weight.'"> gam';
            echo '<div class="help-block help-block-error "></div>';
            echo '</div>';

            array_push($unit_array, $ingredient_unit->measureunit_id);
        }
    }
    ?>
</div>

<script type="text/javascript">
    var list_unit_selected = <?php echo '["' . implode('", "', $unit_array) . '"]' ?>;
    var measure_unit= JSON.parse('<?php echo json_encode(\app\models\Measureunit::dropdown_json());?>');
    //append unit list
    function appendUnitToList(value, label, list_id){
        var html="<div class='form-group col-sm-2'> ";
        html +="<a class='unit_item' value='"+value+"' label='"+label+"' href='javascript:void(0)'><i class='fa fa-hand-o-up'> </i>"+label+"</a></div>";
        $('#'+list_id).append(html);
    }

    //append unit selected
    function appendUnitSelected(value, label){
        var html = "<div class='form-group field-ingredientunit-weight required col-sm-6'>"
        html+= "<div class='col-sm-3'>"
        html += "<input type='hidden' name='IngredientUnit["+value+"][measureunit_id]' value='"+value+"'>"
        html += "<a class='unit_item_selected' value='"+value+"' label='"+label+"' href='javascript:void(0)'><i class='fa fa-trash-o' style='color: red'> </i>"+label+"</a>";
        html += "</div>"
        html += "<input class='validate[required,custom[number],min[1]]' name='IngredientUnit["+value+"][weight]' id='ingredientunit-weight' placeholder='trọng lượng ...'> gam"
        html += "<div class='help-block help-block-error '></div>";
        html += "</div>";
        return html;
    }
    //check
    function check_item_exists_in_list(value_selected, label_selected, list_id){
        var is_exists=0;
        $('#'+list_id).children('div').each(function () {
            var value = $(this).find('.unit_item').attr('value');
            if(value_selected === value){
                is_exists=1;
            }
        });
        if(is_exists==0){
            appendUnitToList(value_selected, label_selected, list_id);
        }
        //return false;
    }

    function initial(){
        //initial append unit to list
        for (i = 0; i < measure_unit.length; i++) {
            var value = measure_unit[i]['value'];
            var label = measure_unit[i]['label'];
            appendUnitToList(value, label, 'ingre_unit_input');
            //remove unit in list when update
            $('#ingre_unit_input').children('div').each(function () {
                var value = $(this).find('.unit_item').attr('value');
                if(list_unit_selected.indexOf(value) !=-1){
                    $(this).remove();
                }
            });

        }
    }

    initial();

    $( "#search_ingre_unit_input" ).autocomplete({
        source: measure_unit,
        focus: function(event, ui) {
            // prevent autocomplete from updating the textbox
            event.preventDefault();
            // manually update the textbox
            $(this).val(ui.item.label);
        },
        select: function(event, ui) {
            // prevent autocomplete from updating the textbox
            event.preventDefault();
            // manually update the textbox and hidden field
            $(this).val('');
            //set value
            var unit_value = (ui.item.value).toString();
            var unit_label = (ui.item.label).toString();
            //check in stored
            if(list_unit_selected.indexOf(unit_value)==-1){
                $('#list_unit_selected').append(appendUnitSelected(unit_value, unit_label));
                list_unit_selected.push(unit_value);
                //remove in unit list
                $('#ingre_unit_input').children('div').each(function () {
                    var value = $(this).find('.unit_item').attr('value');
                    if(unit_value === value){
                        $(this).remove();
                    }
                });
            }else{
                alert('Đơn vị này đã có');
            }
        }
    });
</script>

<script type="text/javascript">
    $(document).ready(function(){
        $("#w0").validationEngine('attach');
    });

    $(window).ready(function () {
        $(document).on('click','.unit_item',function(){
            //set value
            var unit_value = $(this).attr('value');
            var unit_label = $(this).attr('label');
            //check in stored
            if(list_unit_selected.indexOf(unit_value)==-1){
                $('#list_unit_selected').append(appendUnitSelected(unit_value, unit_label));
                list_unit_selected.push(unit_value);
                $(this).parent().remove();
            }else{
                alert('Đơn vị này đã có');
                $(this).parent().remove();
            }
        });

        $(document).on('click','.unit_item_selected',function(){
            //set value
            var unit_value = $(this).attr('value');
            var unit_label = $(this).attr('label');
            //check in stored

            var index = list_unit_selected.indexOf(unit_value);
            if (index > -1) {//remove in list array
                list_unit_selected.splice(index, 1);
            }
            //check for append back to list
            check_item_exists_in_list(unit_value, unit_label,'ingre_unit_input');
            //appendUnitToList(unit_value, unit_label, 'ingre_unit_input')
            //remove item
            $(this).closest('div').parent().remove();
        });
    });
</script>
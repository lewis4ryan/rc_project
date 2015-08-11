<!-- script validate-->
jQuery(document).ready(function () {
    jQuery('#w0').yiiActiveForm([{"id":"ingredient-name","name":"name","container":".field-ingredient-name","input":"#ingredient-name","error":".help-block.help-block-error","validate":function (attribute, value, messages, deferred, $form) {yii.validation.required(value, messages, {"message":"Tên cannot be blank."});yii.validation.string(value, messages, {"message":"Tên must be a string.","max":50,"tooLong":"Tên should contain at most 50 characters.","skipOnEmpty":1});}},{"id":"ingredient-description","name":"description","container":".field-ingredient-description","input":"#ingredient-description","error":".help-block.help-block-error","validate":function (attribute, value, messages, deferred, $form) {yii.validation.string(value, messages, {"message":"Mô t? must be a string.","skipOnEmpty":1});}},{"id":"ingredient-ingre_group_id","name":"ingre_group_id","container":".field-ingredient-ingre_group_id","input":"#ingredient-ingre_group_id","error":".help-block.help-block-error","validate":function (attribute, value, messages, deferred, $form) {yii.validation.required(value, messages, {"message":"Nhóm nguyên li?u cannot be blank."});yii.validation.number(value, messages, {"pattern":/^\s*[+-]?\d+\s*$/,"message":"Nhóm nguyên li?u must be an integer.","skipOnEmpty":1});}},{"id":"ingredientunit-measureunit_id","name":"measureunit_id","container":".field-ingredientunit-measureunit_id","input":"#ingredientunit-measureunit_id","error":".help-block.help-block-error","validate":function (attribute, value, messages, deferred, $form) {yii.validation.required(value, messages, {"message":"??n v? cannot be blank."});yii.validation.number(value, messages, {"pattern":/^\s*[+-]?\d+\s*$/,"message":"??n v? must be an integer.","skipOnEmpty":1});}},{"id":"ingredientunit-weight","name":"weight","container":".field-ingredientunit-weight","input":"#ingredientunit-weight","error":".help-block.help-block-error","validate":function (attribute, value, messages, deferred, $form) {yii.validation.required(value, messages, {"message":"Tr?ng l??ng cannot be blank."});yii.validation.number(value, messages, {"pattern":/^\s*[-+]?[0-9]*\.?[0-9]+([eE][-+]?[0-9]+)?\s*$/,"message":"Tr?ng l??ng must be a number.","skipOnEmpty":1});}}], []);
});

var list_unit_selected=[];
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
    html += "<input type='text' name='IngredientUnit["+value+"][weight]' id='ingredientunit-weight' placeholder='trọng lượng ...'>"
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
//initial append unit to list
for (i = 0; i < measure_unit.length; i++) {
    var value = measure_unit[i]['value'];
    var label = measure_unit[i]['label'];
    appendUnitToList(value, label, 'ingre_unit_input');
    }

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

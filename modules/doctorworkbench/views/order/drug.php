
<?=$this->render('../default/panel_top',[
'emr' => '',
'lab' => '',
'drug' => 'active',
'diagnosis' => '',
'medication' => '',
'procedure' => '',
'pre_order_lab' =>'',
'apointment' => '',
'treatmment_plan' => '',
'cc' => '',
'pi' => '',
              'pe' => ''

]);?>
<?php
   echo $this->render('@app/modules/drug/views/pccmed/index',[
    'searchModel' => $searchModel,
    'dataProvider' => $dataProvider,
]);
?>
<?=$this->render('../default/panel_foot');?>


<?php
// $js = <<< JS
// $("input[type='checkbox']").change(function(){
//     if(this.checked) {
//     $('.'+$(this).attr('name')+'').prop('checked', true);
//     }else{
//         $('.'+$(this).attr('name')+'').prop('checked', false);
//     }
// });

// $('#remed').click(function(){
// var keys = $("#w0").yiiGridView("getSelectedRows");
// $.ajax({
//     method:'POST',
//     dataType:'json',
//     url:'index.php?r=doctorworkbench/pcc-medication/re-med',
//     data:{id:keys.join()},
//     success:function(response) {
//              swal(response.msg);

//             },
    
// });
// });
// JS;
// $this->registerJS($js);
?>

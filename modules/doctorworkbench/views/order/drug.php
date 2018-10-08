<?php
use yii\bootstrap\Modal;

?>



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
'pe' => '',
'education' => ''

]);?>
<?php
   echo $this->render('@app/modules/drug/views/pccmed/index',[
    'searchModel' => $searchModel,
    'dataProvider' => $dataProvider,
]);
?>


<?=$this->render('../default/panel_foot');?>

<?php
$js = <<< JS
$('.progress').hide();
$("input[type='checkbox']").change(function(){
    if(this.checked) {
    $('.'+$(this).attr('name')+'').prop('checked', true);
    }else{
        $('.'+$(this).attr('name')+'').prop('checked', false);
    }
});

$('#remed').click(function(){
var keys = $("#w0").yiiGridView("getSelectedRows");
$('.progress').show();

var i = 1;
$.each(keys, function (index, value) {

$.ajax({
    method:'POST',
    dataType:'json',
    async: true,
    url:'index.php?r=doctorworkbench/pcc-medication/re-med',
    data:{id:value,count:keys.length},
    beforeSend: function(response){

  },
    success:function(response) {
       var total = parseInt(keys.length);
       var n = i++;
       var p = ((n / total) * 100).toFixed( 0 );
       $('#p').html(p+'%');
       $('#p').css('width',p+'%');
       if(p==100){
        $('.progress').hide();
    }

    },
    
    });
});

});



JS;
$this->registerJS($js);
?>

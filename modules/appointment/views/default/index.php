<?php

use kartik\grid\GridView;
use yii\bootstrap\Modal;
use yii\helpers\Html;
?>

<?php
Modal::begin([
    'header' => '<h4>บันทึกการนัด</h4>',
    'id' => 'modal',
    'options' => [
        'tabindex' => FALSE
    ],
    'size' => 'modal-md'
]);
echo "<div id='modalContent'></div>";
Modal::end();
?>

<div class="col-md-6 box-shadow" >
    <div style="margin-top: 10px;margin-bottom: 10px">
        <?php
        echo \yii2fullcalendar\yii2fullcalendar::widget(array(
            'events' => $events,
            'options' => [
                'lang' => 'th',
            //... more options to be defined here!
            ],
        ));
        ?> 

    </div>
</div>

<div class="col-md-5 col-md-offset-1 box-shadow">

    <div class="row">
    <div class="form-group button-box-shadow ">
    <b>ประวัติการนัดหมาย </b> 
       
    </div>
    </div>
    <div class="row" style="margin : 20px;margin-top: 30px">
        <?=
        GridView::widget([
            'dataProvider' => $dataProvider,
            //'filterModel' => $searchModel,
            //'showPageSummary'=>true,
            'pjax' => true,
            'pjaxSettings' => [
                'neverTimeout' => true,
            ],
            'striped' => true,
            'hover' => true,
            'columns' => [
                ['class' => 'kartik\grid\SerialColumn'],
                [ 
                    'attribute'=>'hospname',
                    'label'=>'สถานที่รับบริการ'
                ],
                 [ 
                    'attribute'=>'date_visit',
                    'label'=>'วันที่รับบริการ'
                ],
                 [ 
                    'attribute'=>'appoint_date',
                    'label'=>'วันนัด'
                ],
                 [ 
                    'attribute'=>'clinic',
                    'label'=>'คลินิก'
                ],
                 [ 
                    'attribute'=>'appoint_doctor',
                    'label'=>'แพทย์ผู้นัด'
                ],
                 [ 
                    'attribute'=>'appoint_detail',
                    'label'=>'รายละเอียด'
                ],
               
            ],
        ]);
        ?>
    </div>

</div>






<?php
$script = <<< JS
   
        
        
 $('#btnadd').click(function() {
        var date = '';
        $.get('index.php?r=appointment/appoint/create',{'date':date,'type':1},function(data){
            $('#modal').modal('show')
            .find('#modalContent')
            .html(data);
        
         });
        
   });
        
   $('#btnedit').click(function() {
       window.location='./index.php?r=oapp/oappevent/oedit';
   });

   
 $(document).on('click','.fc-day',function(){
     var date = $(this).attr('data-date');
       $.get('index.php?r=appointment/appoint/create',{'date':date,'type':0},function(data){
            $('#modal').modal('show')
            .find('#modalContent')
            .html(data);
        
         });
      
        
   });
  $(document).on('click','.fc-content',function(){
     var date = $(this).attr('data-date');
       $.get('index.php?r=appointment/appoint/create',{'date':date,'type':0},function(data){
            $('#modal').modal('show')
            .find('#modalContent')
            .html(data);
        
         });
      
        
   });
   $(document).on('click','.fc-day-top',function(){
     var date = $(this).attr('data-date');
       $.get('index.php?r=appointment/appoint/create',{'date':date,'type':0},function(data){
            $('#modal').modal('show')
            .find('#modalContent')
            .html(data);
        
         });
      
        
   });

   
JS;
$this->registerJs($script);

$this->registerCss("
.box-shadow {
    -webkit-box-shadow: 0 0 10px 0 rgba(0,0,0,.15);
    box-shadow: 0 0 10px 0 rgba(0,0,0,.15);
    
}

.button-box-shadow {
    -webkit-box-shadow: 0 0 10px 0 rgba(0,0,0,.10);
    box-shadow: 0 0 10px 0 rgba(0,0,0,.10);
    margin:5px;
    padding: 5px;
    background: #00e676;
}
.cctext{
    font-size: 22px;
    -webkit-border-radius: 8px;
       -moz-border-radius: 8px;
            border-radius: 8px;
}

.btn-pop {
    //padding: 5px 5px;
    margin:5px;
    font-size: 16px;
    color: #ffffff;
    background: #00e676;
    width:auto;
    line-height: normal;
    -webkit-border-radius: 8px;
       -moz-border-radius: 8px;
            border-radius: 8px;
    }

.btn-pop-info {
    margin:5px;
    font-size: 16px;
    color: #ffffff;
    background: #f50057;
    width:auto;
    line-height: normal;
        -webkit-border-radius: 8px;
        -moz-border-radius: 8px;
    border-radius: 8px;
    }
");
?>
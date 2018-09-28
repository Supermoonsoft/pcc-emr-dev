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

<div class="col-md-6">
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

<div class="col-md-6" >
    <div class="row" style="text-align: right;">
        <button class="btn btn-success" id="btnadd">ลงนัด</button>
    </div>

    <div class="row" style="margin-top: 15px">
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
                'provider_name',
                'date_visit',
                //'time_visit',
                'appoint_date',
                'clinic',
                'appoint_doctor',
                'appoint_detail',
                
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
        

   
JS;
$this->registerJs($script);
?>
<?php

use yii\helpers\Html;
use kartik\grid\GridView;
//use yii\widgets\Pjax;
//use app\components\DbHelper;
//use yii\web\JsExpression;
//use app\components\loading\ShowLoading;
use yii\helpers\Url;
//echo ShowLoading::widget();
?>
<?php
// $this->registerJs('
// $("#btn-add").click(function(){
//     var id_case = $("#gridview-id").yiiGridView("getSelectedRows");

//     console.log(id_case);

//     if(id_case.length > 0){
//         $.ajax({
//             url: "'.Url::to(['/lab/pcclab/addgroup']).'",
//             dataType: "JSON",
//             type: "POST",
//            // contentType: "application/x-www-form-urlencoded",
//             //data: $(this).serialize(),
//             // success: function( data, textStatus, jQxhr ){
//             //     alert(data);
                
//             // },
//             data:{id:id_case},
//             success: function(response){
//                 console.log(response);
//             }
//             error: function( jqXhr, textStatus, errorThrown ){
//                 console.log( errorThrown );
//             }
//         });

//     }
//   });
// ')


?>
<div class="hoslab-index">

        <div style="margin-bottom: 3px">
        <?php $alert = 'swal("ส่งทีละหลายรายการ...")' ;?>
            
            <?php // Html::a('<button id="btn-add" onClick='.new JsExpression($alert).' class="btn btn-info" ><i class="fa fa-check"></i> ส่งรายการเฉพาะที่เลือก ไปยัง PreOrder Lab</button>', ['/doctorworkbench/order/pre-order-lab']) ?>
            <button id="btn-add" class="btn btn-info"  ><i class="fa fa-check"></i> ส่งรายการเฉพาะที่เลือก ไปยัง PreOrder Lab</button>
        </div>

    <?php Pjax::begin(); ?>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        //'filterModel' => $searchModel,
        //'showPageSummary'=>true,
        'pjax'=>true,
        'pjaxSettings'=>[
            'neverTimeout'=>true,
        ],
        'options' => [
            'id' => 'gridview-id'
        ],
        'striped'=>true,
        'hover'=>true, 
		'panel' => [ 'befor' => 'Lab History'],
        'formatter' => ['class' => 'yii\i18n\Formatter', 'nullDisplay' => '-'], 
        'rowOptions' => function ($model, $key, $index, $grid) { //สามารถกำหนด data-key ใหม่ (ปกติจะใช้ PK)
            return ['data' => ['key' => $model->id]];
        }, 
        'columns' => [
            
            [
                'attribute'=>'date_visit', 
                'value'=>function ($model, $key, $index, $widget) { 
                    return $model->date_visit.' (รพ.แม่ข่าย)';
                },
                'filter'=>false,
                'group'=>true,  // enable grouping,
                'groupedRow'=>true,                    // move grouped column to a single grouped row
                'groupOddCssClass'=>'kv-grouped-row',  // configure odd group cell css class
                'groupEvenCssClass'=>'kv-grouped-row', // configure even group cell css class
            ],
            /*[
                'class' => 'yii\grid\CheckboxColumn',
                'header' => false,
                
            ],*/
            [
                'class' => 'yii\grid\CheckboxColumn',
                'checkboxOptions' => function($model) {
                    return ['value' => $model->id, 'data' => ['key' => $model->id]];
                },
                'header' => false,
            ],
            [
                'attribute'=>'lab_name',
                'options' => ['id' => 'lab_name'],
                'value'=>function ($model, $key, $index, $widget) { 
                    return $model->lab_name;
                },
            ],
            [
                'attribute'=>'lab_result_date',
                'options' => ['id' => 'lab_result_date'],
                'value'=>function ($model, $key, $index, $widget) { 
                    return $model->lab_result_date;
                },
            ],
            [
                'attribute'=>'lab_result',
                'options' => [ 'id' => 'lab_result'],
                'value'=>function ($model, $key, $index, $widget) { 
                    return $model->lab_result;
                },
            ],
            [
                'attribute'=>'standard_result',
                'options' => [ 'id' => 'standard_result'],
                'value'=>function ($model, $key, $index, $widget) { 
                    return $model->standard_result;
                },
            ],
            [
                'width'=>'310px',
                'label'=>'หมายเหตุ'
            ],

        ],
    ]); ?>
    <?php Pjax::end(); ?>

</div>

<?php


$js  = <<< JS
$("#btn-add").click(function(){
 var id_case = $("#gridview-id").yiiGridView("getSelectedRows");
 $.ajax({
         type: "get",
         url: "index.php?r=lab/pcclab/test",
         dataType: "json",
         data:{key:id_case},
         success: function (response) {
           // $.pjax.reload({container: response.forceReload});
           console.log(response);
           location.href = "index.php?r=lab/pcclab/test"
           //window.location = "index.php?r=lab/pcclab/test";
         }

     });

  });

JS;
$this->registerJS($js);
?>
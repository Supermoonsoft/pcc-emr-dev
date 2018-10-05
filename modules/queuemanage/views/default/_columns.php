<?php

use yii\helpers\Url;
use yii\helpers\Html;
use app\modules\doctorworkbench\models\CDrugusage;
use yii\helpers\ArrayHelper;
use kartik\editable\Editable;
use kartik\grid\GridView;
use yii\helpers\Json;

return [
    [
        'class' => 'kartik\grid\CheckboxColumn',
        'width' => '20px',
    ],
    [
        'class' => 'kartik\grid\SerialColumn',
        'width' => '30px',
    ],
    [
        'class'=>'\kartik\grid\DataColumn',
        'header' => 'วันที่',
        'value' => function($model){
        return Yii::$app->formatter->asDateTime($model['visit_date_begin'], 'php:d/m/Y');

        }
       
    ],
   [
       'class' => '\kartik\grid\DataColumn',
       'header' => 'เวลา',
       'value' => function($model){
        return $model['visit_time_begin'];
    }
   
   ],
   [
       'class'=>'\kartik\grid\DataColumn',
       'header'=>'HN',
       'value' => function($model){
        return $model['hn'];
    }
      
   ],
   [
    'header' => 'ชื่อ-สกุล',
    'value' => function($model){
        return $model['fullname'];
    }
   
],
[
    'header' => 'อายุ',
    'value' => function($model){
       return $model['age'];
    }
],
[
    'attribute' => 'visit_department',
    'header' => 'แผนก',
    'value' => function($model){
        return $model['visit_department'];
    }
  
],
//    [
//        'class'=>'\kartik\grid\DataColumn',
//        'header'=>'ความแรง/ขนาด',
//         'value' => function($model){
//             return $model->drugitems->strength;
//         }
//    ],
//      [
//       'class'=>'\kartik\grid\DataColumn',
//       //'attribute' =>'usage_line1',  
//       'attribute' =>'druguse',     
//       'header'=>'วิธีใช้',         
//   ],         

//    [
//        'class' => 'kartik\grid\EditableColumn',
//        //'class'=>'\kartik\grid\DataColumn',
//         'header' => 'จำนวนจ่าย',
//         'pageSummary' => 'มูลค่ารวม',
//         'attribute' => 'qty',
//         'width' => '100px',        
//          'editableOptions' => [
//              'inputType' => \kartik\editable\Editable::INPUT_TEXT,
//              'formOptions' => [
//                  'action' => \yii\helpers\Url::to(['/doctorworkbench/pcc-medication/editable']),
//                  'method' => 'post'
//              ],
//              'valueIfNull' => '-',
//              'submitButton' => ['class' => 'btn btn-primary', 'icon' => '<i class="glyphicon glyphicon-ok"></i>'],
//              'resetButton' => ['class' => 'btn btn-warning', 'icon' => '<i class="glyphicon glyphicon-refresh"></i>'],
//          ],
//     ],
    // [
    //     'class' => '\kartik\grid\DataColumn',
    //     'attribute' => 'totalprice',
    //     'header' => 'รวมราคา',
    //     'format' => ['decimal', 2],
    //     'pageSummary' => true,
    //     'width' => '180px',
    //     // 'value' => function($model) {
    //     //     $total = $model->qty * $model->unitprice;
    //     //     return $total;
    //     // }
    // ],
        // [
        // 'class'=>'\kartik\grid\DataColumn',
        // 'attribute'=>'costprice',
        // ],
        // [
        // 'class'=>'\kartik\grid\DataColumn',
        // 'attribute'=>'totalprice',
        // ],
        // [
        // 'class'=>'\kartik\grid\DataColumn',
        // 'attribute'=>'provider_code',
        // ],
        // [
        // 'class'=>'\kartik\grid\DataColumn',
        // 'attribute'=>'provider_name',
        // ],
        // [
        // 'class'=>'\kartik\grid\DataColumn',
        // 'attribute'=>'date_service',
        // ],
        // [
        // 'class'=>'\kartik\grid\DataColumn',
        // 'attribute'=>'time_service',
        // ],
        // [
        // 'class'=>'\kartik\grid\DataColumn',
        // 'attribute'=>'data_json',
        // ],
        /*
          [
          'class' => 'kartik\grid\ActionColumn',
          'template' => '{delete}',
          'dropdown' => false,
          'vAlign'=>'middle',
          'urlCreator' => function($action, $model, $key, $index) {
          return Url::to([$action,'id'=>$key]);
          },
          'viewOptions'=>['role'=>'modal-remote','title'=>'View','data-toggle'=>'tooltip'],
          'updateOptions'=>['role'=>'modal-remote','title'=>'Update', 'data-toggle'=>'tooltip'],
          'deleteOptions'=>['role'=>'modal-remote','title'=>'Delete',
          'data-confirm'=>false, 'data-method'=>false,// for overide yii data api
          'data-request-method'=>'post',
          'data-toggle'=>'tooltip',
          'data-confirm-title'=>'Are you sure?',
          'data-confirm-message'=>'Are you sure want to delete this item'],
          ],
         */
];

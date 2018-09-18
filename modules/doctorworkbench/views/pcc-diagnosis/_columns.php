<?php
use yii\helpers\Url;

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
        'attribute'=>'icd_code',
        'header' => 'ICD10'
    ],
    [
        'class'=>'\kartik\grid\DataColumn',
        'attribute'=>'icd_name',
        'header' => 'ชื่อโรค'
    ],
    [
        'class'=>'\kartik\grid\DataColumn',
        'attribute'=>'diag_type',
        'header'=> 'ประเภท'
    ],
    [
        'class'=>'\kartik\grid\DataColumn',
        'attribute'=>'provider_name',
        'header'=> 'แพทย์'
    ],
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

];   
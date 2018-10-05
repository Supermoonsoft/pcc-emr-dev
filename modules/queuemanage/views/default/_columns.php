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
          [
          'class' => 'kartik\grid\ActionColumn',
          'header' => 'แก้ไข',
          'template' => '{edit}',
          'dropdown' => false,
          'vAlign'=>'middle',
          'urlCreator' => function($action, $model, $key, $index) {
          return Url::to([$action,'id'=>$key]);
          },
          'buttons'=>[
            'edit' => function($url,$model,$key){
                return Html::a('<i class="far fa-edit"></i>',$url,['style' => 'color:#2f8b9a;']);
              }
            ]
          ],
        
];

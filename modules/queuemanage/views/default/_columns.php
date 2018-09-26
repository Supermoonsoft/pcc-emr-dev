<?php
use yii\helpers\Url;
use kartik\editable\Editable;
use app\modules\queuemanage\models\PccDoctorRoomQueue;

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
        'header' => 'HN',
        'value' => function($model){
            return $model['hn'];
        }
    ],
    [
        'class'=>'\kartik\grid\DataColumn',
        'header' => 'ลำดับ',
        'format' => 'raw',
        'value' => function($model){
            $key = $model['pcc_vn'];
            // $order = PccDoctorRoomQueue::findOne(['pcc_vn' => $model['pcc_vn']]);
            //  return "<div id='".$key."'></div><div id='result".$key."'>".$order->ordernumber."</div>";
        return "<div id='".$key."'></div>";
    
        }
    ],
    [
        'class'=>'\kartik\grid\DataColumn',
        'header' => 'เวลามา',
        'value' => function($model){
            return $model['visit_date_begin'].' '.$model['visit_time_begin'];
        }
    ],
   


];   
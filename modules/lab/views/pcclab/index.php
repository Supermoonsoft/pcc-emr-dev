<?php

use yii\helpers\Html;
use kartik\grid\GridView;
use yii\widgets\Pjax;
use app\components\DbHelper;
use yii\web\JsExpression;
use app\components\loading\ShowLoading;
use yii\helpers\Url;
//echo ShowLoading::widget();
?>
<?php
$this->registerJs('

')

?>
<div class="hoslab-index">

        <div style="margin-bottom: 3px">
        <?php $alert = 'swal("ส่งทีละหลายรายการ...")' ;?>
            
            <?= Html::a('<button id="btn-add" onClick='.new JsExpression($alert).' class="btn btn-info" ><i class="fa fa-check"></i> ส่งรายการเฉพาะที่เลือก ไปยัง PreOrder Lab</button>', ['/doctorworkbench/order/pre-order-lab']) ?>
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
        'columns' => [
            
            [
                'attribute'=>'hos_date_visit', 
                'value'=>function ($model, $key, $index, $widget) { 
                    return $model->date_service.' (รพ.แม่ข่าย)';
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
                'attribute'=>'lab_result_at',
                'options' => ['id' => 'lab_result_at'],
                'value'=>function ($model, $key, $index, $widget) { 
                    return $model->lab_result_at;
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

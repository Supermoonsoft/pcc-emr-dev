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
jQuery("#btn-add").click(function(){
    alert("ส่งทีละหลายรายการ...");
    //window.location.href = "index.php";
    jQuery.post("'.Url::to(['/lab/preorderlab']).'",function(){

    });
});
')

?>
<div class="hoslab-index">
<form method="post" actio="#">
        <div style="margin-bottom: 3px">
        <?php $alert = 'swal("ส่งทีละหลายรายการ...")' ;?>
            <button id="btn-add" class="btn btn-info" ><i class="fa fa-check"></i> ส่งรายการเฉพาะที่เลือก ไปยัง PreOrder Lab</button>
        </div>
        </form>
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
                    return $model->hos_date_visit.' (รพ.แม่ข่าย)';
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
                'attribute'=>'lab_name_hos',
                'options' => ['id' => 'lab_name_hos'],
                'value'=>function ($model, $key, $index, $widget) { 
                    return $model->lab_name_hos;
                },
            ],
            [
                'attribute'=>'result_at',
                'options' => ['id' => 'result_at'],
                'value'=>function ($model, $key, $index, $widget) { 
                    return $model->result_at;
                },
            ],
            [
                'attribute'=>'hos_result',
                'options' => [ 'id' => 'hos_result'],
                'value'=>function ($model, $key, $index, $widget) { 
                    return $model->hos_result;
                },
            ],
            [
                'attribute'=>'lab_normal',
                'options' => [ 'id' => 'lab_normal'],
                'value'=>function ($model, $key, $index, $widget) { 
                    return $model->lab_normal;
                },
            ],
            [
                'attribute'=>'lab_possible', 
                'width'=>'310px',
                'label'=>'หมายเหตุ'
            ],

        ],
    ]); ?>
    <?php Pjax::end(); ?>

</div>

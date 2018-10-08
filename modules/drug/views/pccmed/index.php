<?php

use yii\helpers\Html;
use kartik\grid\GridView;
use yii\widgets\Pjax;
use app\components\DbHelper;
use yii\web\JsExpression;
use app\components\loading\ShowLoading;
use yii\web\View;
//echo ShowLoading::widget();
?>
<div class="hoslab-index">

        <div style="margin-bottom: 3px">
        <?php $alert = 'swal("ส่งทีละหลายรายการ...")' ;?>
            <button class="btn btn-info" id="remed" onClick=<?php //new JsExpression($alert)?>><i class="fa fa-check"></i> ส่งรายการเฉพาะที่เลือก ไปยัง Medication</button>
        </div>
    <?php Pjax::begin(); ?>
<?= GridView::widget([
        'dataProvider' => $dataProvider,
        'pjax'=>true,
        'pjaxSettings'=>[
            'neverTimeout'=>true,
        ],
        'striped'=>true,
        'hover'=>true,       
        'columns' => [
            [
                'attribute'=>'date_service', 
                'format'=>'raw',
                'value'=>function ($model, $key, $index, $widget) { 
                  return Html::checkbox('checkbox').' '.$model->date_visit.' (รพ.แม่ข่าย)';
                },
                'filter'=>false,
                'group'=>true,  // enable grouping,
                'groupedRow'=>true,                    // move grouped column to a single grouped row
                'groupOddCssClass'=>'kv-grouped-row',  // configure odd group cell css class
                'groupEvenCssClass'=>'kv-grouped-row', // configure even group cell css class
            ],
             [
                'class' => 'yii\grid\CheckboxColumn',
                'header' => false,
                'checkboxOptions' =>

                function($model) {
        
                    return ['value' => $model->id, 'class' => $model->vn, 'id' => 'checkbox'];
        
                }
            ],
            'drug_name',
            [
                'attribute'=>'usage_line1',
                'options' => ['id' => 'usage_line1'],
                'value'=>function ($model, $key, $index, $widget) { 
                    $message = $model->usage_line1;
                    return  $message;
                },
                'width'=>'400px',
            ],
            'qty',
            'unit',

        ],
    ]); ?>
    
    <?php Pjax::end(); ?>

</div>


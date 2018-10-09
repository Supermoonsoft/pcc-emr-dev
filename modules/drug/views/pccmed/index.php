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
        
        <div class="row">
            <div class="col-xs-3 col-sm-3 col-md-3 col-lg-3">
            <button class="btn btn-info" id="remed" onClick=<?php //new JsExpression($alert)?>><i class="fa fa-check"></i> ส่งรายการเฉพาะที่เลือก ไปยัง Medication</button>
                
            </div>    
            <div class="col-xs-9 col-sm-9 col-md-9 col-lg-9">
            <div class="progress" style=" height: 34px;margin-bottom: -8px;margin-left: -71px;">
  <div id='p' class="progress-bar progress-bar-success progress-bar-striped active" role="progressbar"
  aria-valuenow="40" aria-valuemin="0" aria-valuemax="100" style="padding-top: 8px; font-size: 20px;">
  100
  </div>
</div>
            </div>
            
        </div>
        
        </div>

<?= GridView::widget([
        'dataProvider' => $dataProvider,
        'pjax'=>false,
        'formatter' => ['class' => 'yii\i18n\Formatter','nullDisplay' => '-'],
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
                  return Html::checkbox($model->vn).' '.$model->date_visit.' (รพ.แม่ข่าย)';
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
            [
                'attribute'=>'drug_name',
                'format' => 'raw',
                'value' => function($model){
                    return '<div >'.$model->drug_name.'&nbsp<span style="color:#0399cc" id="'.$model->id.'"></span></div>';
                }
            ],
            // 'drug_name',
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

</div>


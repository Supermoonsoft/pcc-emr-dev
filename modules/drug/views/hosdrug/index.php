<?php

use yii\helpers\Html;
use kartik\grid\GridView;
use yii\widgets\Pjax;
use app\components\DbHelper;
use yii\web\JsExpression;
use app\components\loading\ShowLoading;
//echo ShowLoading::widget();
?>
<div class="hosdrug-index">
<div class="hoslab-index">
<div class="panel panel-info">
    <div class="panel-heading">
        <div class="panel-title"><i class="fa fa-clock-o" aria-hidden="true"></i> Drug List</div>
    </div>
<div class="panel-body">
        <div style="margin-bottom: 3px">
        <?php $alert = 'swal("ส่งทีละหลายรายการ...")' ;?>
            <button class="btn btn-info" onClick=<?=new JsExpression($alert)?>><i class="fa fa-check"></i> ส่งรายการเฉพาะที่เลือก</button>
        </div>
    <?php Pjax::begin(); ?>
<?= GridView::widget([
        'dataProvider' => $dataProvider,
        //'filterModel' => $searchModel,
        //'showPageSummary'=>true,
        'pjax'=>true,
        'pjaxSettings'=>[
            'neverTimeout'=>true,
            /*'beforeGrid'=>'<div class="col-md-6"><object align="center">'
            .$this->render('_search', ['model' => $searchModel])
            .'</object></div>',*/
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
                //'filterType'=>GridView::FILTER_SELECT2,
                //'filter'=>ArrayHelper::map(Suppliers::find()->orderBy('company_name')->asArray()->all(), 'id', 'company_name'), 
                //'filterWidgetOptions'=>[
                //    'pluginOptions'=>['allowClear'=>true],
                // ],
                //'filterInputOptions'=>['placeholder'=>'Any supplier'],
                'group'=>true,  // enable grouping,
                'groupedRow'=>true,                    // move grouped column to a single grouped row
                'groupOddCssClass'=>'kv-grouped-row',  // configure odd group cell css class
                'groupEvenCssClass'=>'kv-grouped-row', // configure even group cell css class
            ],
            ['class' => 'yii\grid\CheckboxColumn',],
            //['class' => 'yii\grid\SerialColumn'],
            //'drug_code_hos',
            'drug_name_hos',
            'drug_usage',
            'drug_pay_amount',
            'drug_units',
            //'data_json',
            //'drug_code_moph',
            //'drug_name_moph',

            //['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
    <?php Pjax::end(); ?>
</div>
</div>
</div>

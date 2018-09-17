<?php

use yii\helpers\Html;
use kartik\grid\GridView;
use yii\widgets\Pjax;

?>
<div class="hoslab-index">
    <?php Pjax::begin(); ?>


    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        //'filterModel' => $searchModel,
        //'showPageSummary'=>true,
        'pjax'=>true,
        'pjaxSettings'=>[
            'neverTimeout'=>true,
        ],
        'striped'=>true,
        'hover'=>true,
        'panel'=>[
            'type'=>'primary', 
            'heading'=> 'LAB TEST ',
        ],
        
        'columns' => [
            [
                'attribute'=>'cid', 
                'value'=>function ($model, $key, $index, $widget) { 
                    return 'CID : '.$model->cid;
                },
                'group'=>true, 
                'filter'=>true,
                'groupedRow'=>true,
                'groupOddCssClass'=>'kv-grouped-row',  // configure odd group cell css class
                'groupEvenCssClass'=>'kv-grouped-row',
            ],
            [
                'attribute'=>'hos_date_visit', 
                'value'=>function ($model, $key, $index, $widget) { 
                    return "เข้ารับบริการที่ รพ.แม่ข่าย : ".$model->hos_date_visit;
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
            
            ['class' => 'yii\grid\SerialColumn'],
            //'lab_code_hos',
            //'lab_code_moph',
            'request_at',
            'lab_name_hos',
            'result_at',
            'hos_result',
            //'data_json',
            //'lab_name_moph',

            //['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

    <?php Pjax::end(); ?>
</div>

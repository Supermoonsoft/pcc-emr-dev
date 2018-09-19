<?php
use yii\helpers\Html;
use kartik\grid\GridView;
use yii\widgets\Pjax;
use app\components\DbHelper;
use yii\web\JsExpression;
use app\components\loading\ShowLoading;
?>
<?php Pjax::begin(); ?>
<div class="panel panel-success">
    <div class="panel-heading">
        <div class="panel-title"><i class="fa fa-sticky-note-o"></i> EMR </div>
    </div>
<div class="panel-body">

<div class="card">
    <ul class="nav nav-tabs" role="tablist">
        <li role="presentation" class="active"><a href="#emr" aria-controls="emr" role="tab" data-toggle="tab"><i class="glyphicon glyphicon-list-alt"></i>  <span>EMR</span></a></li>
        <li role="presentation"><a href="#lab" aria-controls="lab" role="tab" data-toggle="tab"><i class="glyphicon glyphicon-list-alt"></i>  <span>Lab History</span></a></li>
        <li role="presentation"><a href="#drug" aria-controls="drug" role="tab" data-toggle="tab"><i class="glyphicon glyphicon-list-alt"></i>  <span>Drug History</span></a></li>
        <li role="presentation"><a href="#diag" aria-controls="diag" role="tab" data-toggle="tab"><i class="glyphicon glyphicon-list-alt"></i>  <span>Diagnosis</span></a></li>
        <li role="presentation"><a href="#note" aria-controls="note" role="tab" data-toggle="tab"><i class="glyphicon glyphicon-list-alt"></i>  <span>Medication Note</span></a></li>
        <li role="presentation"><a href="#proced" aria-controls="proced" role="tab" data-toggle="tab"><i class="glyphicon glyphicon-list-alt"></i>  <span>Procedure</span></a></li>
        <li role="presentation"><a href="#appoint" aria-controls="appoint" role="tab" data-toggle="tab"><i class="glyphicon glyphicon-list-alt"></i>  <span>Appointmwnt</span></a></li>
        <li role="presentation"><a href="#preorder" aria-controls="preorder" role="tab" data-toggle="tab"><i class="glyphicon glyphicon-list-alt"></i>  <span>Pre Order</span></a></li>
        <li role="presentation"><a href="#orderlab" aria-controls="orderlab" role="tab" data-toggle="tab"><i class="glyphicon glyphicon-list-alt"></i>  <span>Lab Require</span></a></li>
        <li role="presentation"><a href="#plan" aria-controls="plan" role="tab" data-toggle="tab"><i class="glyphicon glyphicon-list-alt"></i>  <span>Treatment Plan</span></a></li>
    </ul>
<div class="tab-content">
    <div role="tabpanel" class="tab-pane active" id="emr">
        <br>
        ...
    </div>
    <div role="tabpanel" class="tab-pane" id="lab">
    <br>
<?php Pjax::begin(); ?>
    <div style="margin-bottom: 3px">
        <?php $alert = 'swal("ส่งทีละหลายรายการ...")' ;?>
            <button class="btn btn-info" onClick=<?=new JsExpression($alert)?>><i class="fa fa-check"></i> ส่งรายการเฉพาะที่เลือก</button>
        </div>
    <?= GridView::widget([
        'dataProvider' => $dataProvider_lab,
        'pjax'=>true,
        'pjaxSettings'=>[
            'neverTimeout'=>true,
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
            ['class' => 'yii\grid\CheckboxColumn',],
            'lab_name_hos',
            'request_at',
            'hos_result',
            'result_at',
            //['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
    <?php Pjax::end(); ?>
    </div><!-- close tab1-->

    <div role="tabpanel" class="tab-pane" id="drug">
    <br>
<?php Pjax::begin(); ?>
    <div style="margin-bottom: 3px">
        <?php $alert = 'swal("ส่งทีละหลายรายการ...")' ;?>
            <button class="btn btn-info" onClick=<?=new JsExpression($alert)?>><i class="fa fa-check"></i> ส่งรายการเฉพาะที่เลือก</button>
        </div>
<?= GridView::widget([
        'dataProvider' => $dataProvider_drug,
        'pjax'=>true,
        'pjaxSettings'=>[
            'neverTimeout'=>true,
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
            ['class' => 'yii\grid\CheckboxColumn',],
            'drug_name_hos',
            'drug_usage',
            'drug_pay_amount',
            'drug_units',
        ],
    ]); ?>
    <?php Pjax::end(); ?>
    </div><!-- close tab2-->
    <div role="tabpanel" class="tab-pane" id="diag">
        <br>
        ...
    </div>
    <div role="tabpanel" class="tab-pane" id="note">
        <br>
        ...
    </div>
    <div role="tabpanel" class="tab-pane" id="proced">
        <br>
        ...
    </div>
    <div role="tabpanel" class="tab-pane" id="appoint">
        <br>
        ...
    </div>
    <div role="tabpanel" class="tab-pane" id="preorder">
        <br>
        ...
    </div>
    <div role="tabpanel" class="tab-pane" id="orderlab">
        <br>
        ...
    </div>
    <div role="tabpanel" class="tab-pane" id="plan">
        <br>
        ...
    </div>
</div><!-- close tab all-->
</div><!-- close card--->
</div><!-- close panel-body--->
</div><!-- close panel --->
 
<?php Pjax::end(); ?>
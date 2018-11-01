<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use froala\froalaeditor\FroalaEditor;
use froala\froalaeditor\FroalaEditorWidget;
use yii\widgets\Pjax;
use kartik\grid\GridView;

$this->registerJs($this->render('../../dist/js/script.js'));
$this->registerCss($this->render('../../dist/css/style.css'));
?>

<?php
$this->registerCss("

.cctext{
    font-size: 20px;
    margin-left:-7px;
   
}
.control-label{
//color:red;
}
.col-md-2{
    margin-left:-10px;
    
}
.col-md-{
    margin-left:-10px;
}



");
?>


<div class="col-md-6">

    <fieldset>
        <legend class="scheduler-border"><i class="fas fa-file-alt" ></i> Pi Form 

        </legend> 

        <?php Pjax::begin(); ?>
        <?php $form = ActiveForm::begin(['id' => 'form-cc', 'action' => ['/chiefcomplaint/pccservicepi/create'], 'options' => ['data-pjax' => 1],]); ?>
        
        <div class="row" style="margin-top: 20px">
            <div class="col-md-1" style="margin-top: 6px">
                <b> BP : </b>
            </div>
            <div class="col-md-2">
                <?= $form->field($model, 'sbp')->textInput(['placeholder'=>'sbp'])->label(FALSE) ?>
            </div>
            <div class="col-md-2">
                <?= $form->field($model, 'dbp')->textInput(['placeholder'=>'dbp'])->label(FALSE) ?>
            </div>
            
            <div class="col-md-2" style="text-align: right">
                <b> Temp : </b>
            </div>
            
            <div class="col-md-3" >
                <?= $form->field($model, 'temp')->textInput()->label(FALSE) ?>
            </div>
        </div>
        <div class="row" >
            <div class="col-md-1" style="margin-top: 6px">
                <b> PP : </b>
            </div>
            <div class="col-md-2">
                <?= $form->field($model, 'pp')->textInput()->label(FALSE) ?>
            </div>
          
            <div class="col-md-2" style="text-align: right;margin-top: 6px">
                <b> PR : </b>
            </div>
            
            <div class="col-md-2"  >
                <?= $form->field($model, 'pr')->textInput()->label(FALSE) ?>
            </div>
            <div class="col-md-2" style="text-align: right;margin-top: 6px">
                <b> o2sat : </b>
            </div>
            
            <div class="col-md-2"  >
                <?= $form->field($model, 'o2sat')->textInput()->label(FALSE) ?>
            </div>
        </div>
        
        <div class="row" >
            <div class="col-md-2" style="margin-top: 6px;width: 70px">
                <b> Height: </b>
            </div>
            <div class="col-md-2" style="text-align: left;margin-left: -6px">
                <?= $form->field($model, 'height')->textInput()->label(FALSE) ?>
            </div>
          
            <div class="col-md-2" style="text-align: right;margin-top: 6px">
                <b> Weight : </b>
            </div>
            
            <div class="col-md-2"  >
                <?= $form->field($model, 'weight')->textInput()->label(FALSE) ?>
            </div>
            
        </div>
        
       
        <div class="row"> 
            <div class="col-md-12" style="margin-top:10px">
                <?= $form->field($model, 'pi_text')->textarea(['id' => 'pe_text', 'class' => 'form-control cctext', 'rows' => 6]) ?>
            </div> 
        </div><!--- END ROW--->

        <div class="form-group" style="text-align:right;margin-right: 10px" >
            <?php echo Html::submitButton('<i class="fa fa-plus"></i> บันทึก', ['class' => 'btn btn-success', 'id' => 'btn-save']) ?>
        </div>

        <?php ActiveForm::end(); ?>
        <?php Pjax::end(); ?>





    </fieldset>

</div>


<?php
$columns = [
    [
        'class' => 'kartik\grid\SerialColumn',
        'width' => '30px',
    ],
    [
        'class' => '\kartik\grid\DataColumn',
        'width' => '150px',
        'attribute' => 'date_service',
        'value' => function($model) {
            return $model->date_service.' '.$model->time_service;
        }
    ],
    [
        'class' => '\kartik\grid\DataColumn',
        //'width' => '200px',
        'attribute' => 'sbp',
        'value' => function($model) {
            return $model->spb.'/'.$model->dbp;
        }
    ],
            [
        'class' => '\kartik\grid\DataColumn',
        //'width' => '200px',
        'attribute' => 'pp',
        'value' => function($model) {
            return $model->pp;
        }
    ],
            [
        'class' => '\kartik\grid\DataColumn',
        //'width' => '200px',
        'attribute' => 'temp',
        'value' => function($model) {
            return $model->temp;
        }
    ],
            [
        'class' => '\kartik\grid\DataColumn',
        //'width' => '200px',
        'attribute' => 'pr',
        'value' => function($model) {
            return $model->pr;
        }
    ],
            [
        'class' => '\kartik\grid\DataColumn',
        //'width' => '200px',
        'attribute' => 'height',
        'value' => function($model) {
            return $model->height;
        }
    ],
            [
        'class' => '\kartik\grid\DataColumn',
        //'width' => '200px',
        'attribute' => 'weight',
        'value' => function($model) {
            return $model->weight;
        }
    ],
               [
        'class' => '\kartik\grid\DataColumn',
        //'width' => '200px',
        'attribute' => 'weight',
        'value' => function($model) {
            return $model->weight;
        }
    ],
            
    
];
?>

<div class="col-md-6">

    <fieldset style="margin-top:8px">
        <legend class="scheduler-border"><i class="fas fa-file-alt"></i> ประวัติ Pi

        </legend> 
        <div style="margin-top: 10px;margin-right: 7px;margin-left: -10px">
        <?=
        GridView::widget([
            'id' => 'crud-pi',
            'dataProvider' => $dataProvider,
            'pjax' => true,
            'columns' => $columns,
            'formatter' => ['class' => 'yii\i18n\Formatter', 'nullDisplay' => '-'],
            'showPageSummary' => true,
            'striped' => true,
            'condensed' => true,
            'responsive' => true,
            'summary' => false,
            //'layout' => $layout,
            'rowOptions'=>function($model){
                if($model->date_service == Date('Y-m-d')){
                    return ['class' => 'info'];
                }
            },
            'replaceTags' => [
                '{custom}' => function($widget) {
                    if ($widget->panel === true) {
                        return '';
                    } else {
                        return '';
                    }
                }
            ],
            'pager' => [
                'options'=>['class'=>'pagination'], 
                'prevPageLabel' => 'Previous', 
                'nextPageLabel' => 'Next',
                'firstPageLabel'=>'First',
                'lastPageLabel'=>'Last',
                'nextPageCssClass'=>'next',
                'prevPageCssClass'=>'prev',
                'firstPageCssClass'=>'first',
                'lastPageCssClass'=>'last',
                'maxButtonCount'=>10,
        ],        
        ])
        ?>

        </div>

    </fieldset>

</div>
<?php

use yii\helpers\Html;
use kartik\widgets\Select2;
use yii\web\JsExpression;
use yii\web\View;
use yii\helpers\ArrayHelper;
use yii\bootstrap\ActiveForm;
use kartik\datecontrol\DateControl;
use app\modules\lab\models\CLabtest;

$this->registerCss($this->render('@app/modules/doctorworkbench/dist/css/style.css'));


$url = \yii\helpers\Url::to(['/lab/preorderlab/lab-list']); //กำหนด URL ที่จะไปโหลดข้อมูล
$prefix = empty($model->lab_code) ? '' : CLabtest::findOne($model->lab_code)->labname_en; //กำหนดค่าเริ่มต้น

$formatJs = <<< 'JS'

var formatRepo = function (repo) {
    if (repo.loading) {
        return repo.text;
    }
    var markup =
'<div class="row">' + 
    '<div class="col-lg-1 col-md-1 col-sm-1"><code>' + repo.id + '</code></div>' +
    '<div class="col-lg-5 col-md-5 col-sm-5">' + repo.labname_en + '</div>' +
    '<div class="col-lg-6 col-md-6 col-sm-6">' +
        '<p style="margin-left:5px;text-overflow: ellipsis;">' + repo.labname_th+ '</p>' + 
    '</div>' +
'</div>';
    return '<div style="overflow:hidden;">' + markup + '</div>';
};

var formatRepoSelection = function (repo) {
    return repo.full_name || repo.text;
}

JS;

// Register the formatting script
$this->registerJs($formatJs, View::POS_HEAD);

// script to parse the results into the format expected by Select2
$resultsJs = <<< JS
function (data, params) {
    params.page = params.page || 1;
    return {
        results: data.items,
        pagination: {
            more: (params.page * 30) < data.total_count
        }
    };
}
JS;
?>
<?php
$js = <<< JS
$('span > .select2-dropdown').css({"background-color": "yellow", "width": "600px;"});

JS;
$this->registerJS($js);
?>

<div class="preorderlab-form">

<style>
.help-block {
    display: block;
    margin-top: 0px;
    margin-bottom: 0px;
    color: #737373;
}
.form-group {
    margin-bottom: 5px;
}
.select2-container--krajee .select2-dropdown {
    overflow-x: unset;
}
.select2-results {
    width: 1141px;
    border-right: 1px solid #e4e4e4;
    border-top: 1px solid #e4e4e4;
    border-bottom: 1px solid #d2d2d2;
    border-radius: 5px;
}

.box-row{
    display:inline-block;
}
#lab_code{
    margin-left: -250px;
}
</style>
<fieldset style="">
    <legend class="scheduler-border"><i class="fas fa-flask"></i> Pre Order Lab Form
</legend> 
<br>
<?php $form = ActiveForm::begin(['id' => 'form','action' => ['/lab/preorderlab/create']]); ?>
<!-- <div class="box-row" style="width:500px;"> -->

<div class="row">
<div class="col-xs-7 col-sm-7 col-md-7 col-lg-7">
        <?=
    $form->field($model, 'lab_code',[
        'horizontalCssClasses' => [
            'label' => 'col-sm-1',
            // 'offset' => 'col-sm-offset-4',
            'wrapper' => 'col-sm-10',
            'error' => '',
            'hint' => '',
 
        ]
    ])->widget(Select2::className(), [
        'initValueText' => $prefix, //กำหนดค่าเริ่มต้น
        // 'theme' => Select2::THEME_DEFAULT,/
        'options' => ['id' => 'lab_code', 'placeholder' => 'Lab Name...','class' => 'clear fires'],
        'pluginOptions' => [
            'allowClear' => true,
            'minimumInputLength' => 1,
            'language' => [
                'errorLoading' => new JsExpression("function () { return 'Waiting for results...'; }"),
            ],
            'ajax' => [
                'url' => $url,
                'dataType' => 'json',
                'data' => new JsExpression('function(params) { return {q:params.term}; }')
            ],
            'escapeMarkup' => new JsExpression('function (markup) { return markup; }'),
            'templateResult' => new JsExpression('formatRepo'),
        ],
        'pluginEvents' => [
            "select2:select" => "function() { $('#btn-save').focus(); }",
         ]
    ])->label('ชื่อแลป');
    ?>
   
    </div>
    <div class="col-xs-2 col-sm-2 col-md-2 col-lg-2">
        
<?= $form->field($model, 'lab_request_date',[
        'horizontalCssClasses' => [
            'label' => 'col-sm-2',
           'wrapper' => 'col-sm-8',
        ]
    ])->widget(DateControl::classname(), [
        'type'=>DateControl::FORMAT_DATE,
        'ajaxConversion'=>false,
        'widgetOptions' => [
            'pluginOptions' => [
                'autoclose' => true
            ]
        ]
    ])->label('วันสั่ง') ?>
    </div>
    <div class="col-xs-2 col-sm-2 col-md-2 col-lg-2">
    <?= $form->field($model, 'lab_result_date',[
        'horizontalCssClasses' => [
            'label' => 'col-sm-2',
            'wrapper' => 'col-sm-8',
        ]
    ])->widget(DateControl::classname(), [
        'type'=>DateControl::FORMAT_DATE,
        'ajaxConversion'=>false,
        'widgetOptions' => [
            'pluginOptions' => [
                'autoclose' => true
            ]
        ]
    ])->label('วันนัด') ?>
        </div>
        <div class="col-xs-1 col-sm-1 col-md-1 col-lg-1">
        <div class="form-group pull-left" style="margin-top:25px;">
        <?= Html::submitButton('<i class="fas fa-plus"></i>', ['class' => 'btn btn-success','id' => 'btn-save']) ?>
        <?php // Html::button('<i class="fa fa-trash"></i> ลบรายการ', ['class' => 'btn btn-danger','id'=>'btn-delete','style' => 'margin-bottom:0px;']) ?>
        </div>
    </div>
</div>
    <?php ActiveForm::end(); ?>
    </fieldset>
</div>

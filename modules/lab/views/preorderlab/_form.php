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
$prefix = empty($person->prefix_id) ? '' : BasePrefix::findOne($model->prefix_id)->prefix_name; //กำหนดค่าเริ่มต้น

$formatJs = <<< 'JS'

var formatRepo = function (repo) {
    if (repo.loading) {
        return repo.text;
    }
    var markup =
'<div class="row">' + 
    '<div class="col-lg-2 col-md-2 col-sm-2"><code>' + repo.id + '</code></div>' +
    '<div class="col-lg-5 col-md-5 col-sm-5">' + repo.labname_en + '</div>' +
    '<div class="col-lg-5 col-md-5 col-sm-5">' +
        '<b style="margin-left:5px">' + repo.labname_th+ '</b>' + 
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
</style>
<fieldset>
    <legend class="scheduler-border"><i class="fas fa-flask"></i> Pre Order Lab Form
</legend> 
<br>
<?php $form = ActiveForm::begin(['layout' => 'horizontal']); ?>


<div class="row" style="">
    <div class="col-xs-4 col-sm-4 col-md-4 col-lg-4">
    <?= $form->field($model, 'lab_request_date',[
        'horizontalCssClasses' => [
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
    <div class="col-xs-4 col-sm-4 col-md-4 col-lg-4" style="margin-left: -95px;">
    <?= $form->field($model, 'lab_result_date',[
        'horizontalCssClasses' => [
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
        <div class="col-xs-4 col-sm-4 col-md-4 col-lg-4">
        <?= $form->field($model, 'provider_name',[
        'horizontalCssClasses' => [
            'wrapper' => 'col-sm-8',
        ]
    ])->textInput(['maxlength' => true])->label('ผุ้สั่ง') ?>
        </div>

</div>
<div class="row">
    <div class="col-xs-8 col-sm-8 col-md-8 col-lg-8" style="width: 1033px;margin-left: -140px;">
        <?=
    $form->field($model, 'lab_name',[
        'horizontalCssClasses' => [
            'wrapper' => 'col-sm-8',
        ]
    ])->widget(Select2::className(), [
        'initValueText' => $prefix, //กำหนดค่าเริ่มต้น
        // 'theme' => Select2::THEME_DEFAULT,/
        'options' => ['id' => 'lab_name', 'placeholder' => 'Lab Name...','class' => 'clear'],
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
            "select2:select" => "function() { $('#diag_type').select2('open'); }",
        ]
    ])->label('ชื่อแลป');
    ?>
        
        </div>
        <div class="col-xs-4 col-sm-4 col-md-4 col-lg-4" style="margin-left: -45px;">
    <?= $form->field($model, 'lab_code',[
        'horizontalCssClasses' => [
            // 'wrapper' => 'col-sm-8',
        ]
    ])->textInput(['maxlength' => true,'placeholder' => 'Lab Code...'])->label('รหัสแลป') ?>
        
    </div>

       
</div>

<div class="row">
<div class="col-xs-10 col-sm-10 col-md-10 col-lg-10">
    
</div>

    <div class="col-xs-4 col-sm-4 col-md-4 col-lg-4">
        <div class="form-group pull-left" style="margin-left:119px;">
        <?= Html::submitButton('<i class="fas fa-plus"></i> บันทึก', ['class' => 'btn btn-success']) ?>
    </div>
        </div>
</div>






    <?php ActiveForm::end(); ?>
    </fieldset>
</div>

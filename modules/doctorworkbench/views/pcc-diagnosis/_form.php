<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\widgets\Select2;
use yii\web\JsExpression;
use yii\web\View;
use yii\helpers\Url;
use yii\helpers\ArrayHelper;
use app\modules\doctorworkbench\models\CIcd10tm;

$url = \yii\helpers\Url::to(['icd10-list']); //กำหนด URL ที่จะไปโหลดข้อมูล

// $prefix = empty($model->id) ? '' : CIcd10tm::findOne($model->icd_code)->diagcode; //กำหนดค่าเริ่มต้น
$action_create = Url::to(['create']);
$action_update = Url::to(['update']);

if($model->id){
    $action = Url::to(['update','id' => $model->id]);
    if($model->icd_code){
        $fix = CIcd10tm::findOne($model->icd_code);
        $prefix = '('.$fix->diagcode.') - '.$fix->diagename.' - '.$fix->diagtname;
    }else{
    $prefix = '';
    }
    
}else{
    $action = Url::to(['create']);
    $prefix = '';

}
$formatJs = <<< 'JS'
var formatRepo = function (repo) {
    if (repo.loading) {
        return repo.text;
    }
    var markup =
'<div class="row">' + 
    '<div class="col-lg-5 col-md-5 col-sm-5">' + repo.diagename + '</div>' +
    '<div class="col-lg-5 col-md-5 col-sm-5">' + repo.diagtname + '</div>' +
    '<div class="col-lg-2 col-md-2 col-sm-2">' +
        '<b style="margin-left:5px"><code>' + repo.id+ '</code></b>' + 
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
<style>
    .select2-container--krajee .select2-selection--multiple {
        min-height: 123px;
    }
    .btn-diag-info {
    color: #ffffff;
    background-color: #009ee1;
    border-color:#ffffff00;
}
.btn-diag-info:hover{
    color: #ffffff;
    background-color: #0886bb;
    border-color: #ffffff00;
}

</style>
<div class="pcc-diagnosis-form">
<fieldset>
    <legend class="scheduler-border"><i class="fas fa-user-md"></i> Diagnosis Form 
    <button class="btn btn-default"><i class="fas fa-address-card"></i> General</button>
    <button class="btn btn-green"><i class="fas fa-female"></i> Obs-Gyn</button>
    <button class="btn btn-diag-info"><i class="fas fa-user-md"></i> Surgery</button>
    <button class="btn btn-primary"><i class="fas fa-pills"></i> Medicine</button>
    <button class="btn btn-warning"><i class="fas fa-child"></i> Pediatric</button>
    <button class="btn btn-danger"><i class="fas fa-user-md"></i> E-E-N-T</button>
</legend> 

<span id="create" action="<?=$action_create;?>"></span>
<span id="update" action="<?=$action_update;?>"></span>
<span class="get_id" id="" ></span>
<div id="some-element" data=""></div>
<div id="text"></div>

    <?php $form = ActiveForm::begin(['id' => 'form-diagnosis', 'action' => $action, 'options' => ['data-pjax' => 1],]); ?>
    <?php echo $form->field($model, 'id')->hiddenInput(['id' => 'id','disabled' => true])->label(false); ?>
    <?= $form->field($model, 'hn')->hiddenInput()->label(false); ?>
        <?= $form->field($model, 'vn')->hiddenInput()->label(false); ?>
        <?= $form->field($model, 'pcc_vn')->hiddenInput()->label(false); ?>
        <?= $form->field($model, 'cid')->hiddenInput()->label(false); ?>

<div class="row">
    <div class="col-xs-4 col-sm-4 col-md-4 col-lg-4">
    <?=
       // $form->field($model, 'cc')->widget(Select2::className(), [
       // 'data' => ArrayHelper::map(CDiagtext::find()->all(), 'id', 'text'),
        // 'options' => [
        //     'placeholder' => 'Diagtext',
        //     'multiple' => true,
        //     'id' => 'cc',
        //     'class' => 'clear',
        //     // 'value' => ['01', '02', '03'],
        // ],
        // 'pluginOptions' => [
        //     'tags' => true,
        //     'allowClear' => true,
        //     'tokenSeparators' => [',', ' '],
        //     'maximumInputLength' => 50
        // ],])->label(false);
    $form->field($model, 'diag_text')->textInput(['id' => 'diag_text','placeholder' => 'Diagtext'])->label(false);
    ?>
    </div>
    <div class="col-xs-5 col-sm-5 col-md-5 col-lg-5">
    <?=
    $form->field($model, 'icd_code')->widget(Select2::className(), [
        'initValueText' => $prefix, //กำหนดค่าเริ่มต้น
        // 'initValueText' => '', //กำหนดค่าเริ่มต้น
        // 'theme' => Select2::THEME_DEFAULT,/
        // 'data' => ArrayHelper::map(CIcd10tm::find()->limit(10)->all(), 'diagcode', function($model, $defaultValue) {
        //     return $model->diagcode.' '.$model->diagtname;
        // }),
        'options' => ['id' => 'icd_code', 'placeholder' => 'Select ICD10...','class' => 'clear'],
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
    ])->label(false);
    ?>
        </div>
 
        <div class="col-xs-2 col-sm-2 col-md-2 col-lg-2">
            
      <?=
    $form->field($model, 'diag_type')->widget(Select2::className(), [
        'data' => ArrayHelper::map(app\modules\doctorworkbench\models\CDiagtype::find()->orderBy(['diagtype' => SORT_ASC])->all(), 'diagtype', function($model, $defaultValue) {
                    return $model->diagtype . '-' . $model->name1;
                }),
        'options' => [
            'placeholder' => 'DiagType...','id' => 'diag_type'],
        'pluginOptions' => [
            'allowClear' => true,
        ],
        'pluginEvents' => [
            "select2:select" => "function() { $('#btn-save').focus(); }",
        ]
    ])->label(false);
    ?>
        </div>
        <div class="col-xs-1 col-sm-1 col-md-1 col-lg-1">
        <?php if($model->id):?>
<?php echo Html::submitButton('<i id="icon" class="fa fa-edit"></i><span id="btn_text"></span>', ['class' => 'btn btn-warning', 'id' => 'btn-save']) ?>
<?php else:?>
        <?php echo Html::submitButton('<i id="icon" class="fa fa-plus"></i><span id="btn_text"></span>', ['class' => 'btn btn-success', 'id' => 'btn-save']) ?>
        <?php endif;?>
<?php // echo Html::button('<i class="fa fa-trash"></i> ลบรายการ', ['class' => 'btn btn-danger', 'id' => 'btn-delete', 'style' => 'margin-left:5px;']) ?>    
   
            </div>
    
</div>

 
    </fieldset>

    </div>

<?php ActiveForm::end(); ?>


<?php 
$js = <<< JS

JS;
$this->registerJS($js);

?>

<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\widgets\Select2;
use yii\web\JsExpression;
use yii\web\View;

$this->registerJs($this->render('../../dist/js/script.js'));
$this->registerCss($this->render('../../dist/css/style.css'));

$url = \yii\helpers\Url::to(['/education/education/proced']);//กำหนด URL ที่จะไปโหลดข้อมูล
$prefix = empty($person->prefix_id) ? '' : BasePrefix::findOne($model->prefix_id)->prefix_name;//กำหนดค่าเริ่มต้น

$formatJs = <<< 'JS'
var formatRepo = function (repo) {
    if (repo.loading) {
        return repo.text;
    }
    var markup =
'<div class="row">' + 
    '<div class="col-lg-2 col-md-2 col-sm-2">' +
        '<b style="margin-left:5px"><code>' + repo.id+'</code></b>' + 
    '</div>' +
    '<div class="col-lg-9 col-md-9 col-sm-9">' + repo.text + '</div>' +
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

<div class="pcc-service-education-form">

    <?php $form = ActiveForm::begin(['id' => 'form-education', 'action' => ['/education/education/create'], 'options' => ['data-pjax' => 1],]); ?>

    <?= $form->field($model, 'hn')->hiddenInput()->label(false); ?>
    <?= $form->field($model, 'provider')->hiddenInput()->label(false); ?>
    <?= $form->field($model, 'pcc_vn')->hiddenInput()->label(false); ?>
    <?= $form->field($model, 'cid')->hiddenInput()->label(false); ?>
    <?= $form->field($model, 'education_name')->hiddenInput()->label(false); ?>
    <?= $form->field($model, 'hospcode')->hiddenInput()->label(false); ?>
    <?= $form->field($model, 'date_service')->hiddenInput(['value' => date('Y-m-d H:m:s')])->label(false); ?>

    <div class="row">
        <fieldset style="margin-left: 20px;margin-right:20px">
            <legend class="scheduler-border"><i class="fas fa-graduation-cap"></i> Education Form</legend> 
            <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6" style="margin-top: 15px" >


               <?= $form->field($model, 'education_code')->widget(Select2::className(), [
                    'initValueText'=>'',//กำหนดค่าเริ่มต้น
                    // 'theme' => Select2::THEME_DEFAULT,
                    'options'=>['id' => 'education_code','placeholder'=>'Select Education...','class' => 'fires'],
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
                ])->label(false);
                ?>
            </div>
            <div class="col-xs-2 col-sm-2 col-md-2 col-lg-2" style="margin-top: 15px" >

                <?php echo Html::submitButton('<i class="fa fa-plus"></i>', ['class' => 'btn btn-success', 'id' => 'btn-save']) ?>
            </div>  
        </fieldset>
    </div>



    <div class="form-group">
        <?php //echo Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

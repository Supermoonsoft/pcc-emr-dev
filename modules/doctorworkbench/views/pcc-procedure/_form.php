<?php
use yii\helpers\Url;
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\widgets\Select2;
use yii\web\JsExpression;
use yii\web\View;
use app\modules\doctorworkbench\models\CProced;

$url = \yii\helpers\Url::to(['proced']);//กำหนด URL ที่จะไปโหลดข้อมูล
if($model->id){
    $fix = CProced::findOne($model->procedure_code);
    $prefix =  $fix->title.' - '.$fix->title_th;
    $action = Url::to(['update','id' => $model->id]);
}else{
    $prefix ='';
    $action = Url::to(['create']);
}



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
    '<div class="col-lg-9 col-md-9 col-sm-9">' + repo.title + ' - '+repo.title_th+ '</div>' +
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
<div class="pcc-procedure-form">
<?php $form = ActiveForm::begin(['id' => 'form-procedure','action' => $action,'options' => ['data-pjax' => 1],]);?>
   
    <?= $form->field($model, 'hn')->hiddenInput()->label(false);?>
    <?= $form->field($model, 'vn')->hiddenInput()->label(false);?>
    <?= $form->field($model, 'pcc_vn')->hiddenInput()->label(false);?>
    <?= $form->field($model, 'cid')->hiddenInput()->label(false);?>

    <div class="row">
        <div class="col-xs-8 col-sm-8 col-md-8 col-lg-8">
<?= $form->field($model, 'procedure_code')->widget(Select2::className(), [
                    'initValueText'=>$prefix,//กำหนดค่าเริ่มต้น
                    // 'theme' => Select2::THEME_DEFAULT,
                    'options'=>['id' => 'procedure_code','placeholder'=>'Select Procedure...','class' => 'fires'],
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
            <div class="col-xs-2 col-sm-2 col-md-2 col-lg-2">
       
            <?php if($model->id):?>
<?php echo Html::submitButton('<i id="icon" class="fa fa-edit"></i><span id="btn_text"></span>', ['class' => 'btn btn-warning', 'id' => 'btn-save']) ?>
<?php else:?>
        <?php echo Html::submitButton('<i id="icon" class="fa fa-plus"></i><span id="btn_text"></span>', ['class' => 'btn btn-success', 'id' => 'btn-save']) ?>
        <?php endif;?>
    </div>       
    </div>
    <?php ActiveForm::end(); ?>
</div>
<br>
<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\widgets\Select2;
use yii\web\JsExpression;

$url = \yii\helpers\Url::to(['icd10-list']);//กำหนด URL ที่จะไปโหลดข้อมูล
$prefix = empty($person->prefix_id) ? '' : BasePrefix::findOne($model->prefix_id)->prefix_name;//กำหนดค่าเริ่มต้น
// $this->registerJs($this->render('../../dist/js/script.js'));
?>

<div class="pcc-diagnosis-form">
    <?php $form = ActiveForm::begin(['id' => 'form-diagnosis']); ?>
    <div class="row">
        <div class="col-xs-3 col-sm-3 col-md-3 col-lg-3">
<?= $form->field($model, 'icd_code')->widget(Select2::className(), [
                    'initValueText'=>$prefix,//กำหนดค่าเริ่มต้น
                    'options'=>['id' => 'icd_code','placeholder'=>'Select ICD10...'],
                    'pluginOptions'=>[
                        'allowClear'=>true,
                        'minimumInputLength'=>3,//ต้องพิมพ์อย่างน้อย 3 อักษร ajax จึงจะทำงาน
                        'ajax'=>[
                            'url'=>$url,
                            'dataType'=>'json',//รูปแบบการอ่านคือ json
                            'data'=>new JsExpression('function(params) { return {q:params.term};}')
                        ],
                        'escapeMarkup'=>new JsExpression('function(markup) { return markup;}'),
                        'templateResult'=>new JsExpression('function(prefix){ return prefix.text;}'),
                        'templateSelection'=>new JsExpression('function(prefix) {return prefix.text;}'),
                    ]
                ])->label(false);
                ?>
            
            </div>

            
            <div class="col-xs-3 col-sm-3 col-md-3 col-lg-3">
            <div class="form-group">
        <?php // Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>
            </div>
            
    </div>
    


    <?php ActiveForm::end(); ?>

</div>
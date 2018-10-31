<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\widgets\Select2;
use yii\helpers\ArrayHelper;
use yii\widgets\Pjax;
use yii\web\JsExpression;
use app\modules\doctorworkbench\models\CDrugitems;
use app\modules\doctorworkbench\models\CDrugusage;
use app\modules\doctorworkbench\models\GatewayCDrugItems;
use app\modules\doctorworkbench\models\GatewayCDrugdose;
use app\modules\doctorworkbench\models\GatewayCDruguage;
$this->registerJS($this->render('../../dist/js/script.js'));


?>

<style>
.total-price{
    border-top: 3px solid #9b25af;
    box-shadow: 0 0 1px rgba(0,0,0,.125), 0 1px 3px rgba(0,0,0,.2);
    height: 33px;
    width: 158%;
    margin-top: 24px;
    background-color: #eee;
    color: #9b25af; 
    margin-left: -24px;
}
.total-price > p{
    font-size: 25px;
    margin-left: 6px;
}

</style>

<?php


?>
<div class="pcc-medication-form">
    <?php $form = ActiveForm::begin(['id' => 'form-medication','action' => ['create'],'options' => ['data-pjax' => 1],]);?>
    
    <?= $form->field($model, 'hn')->hiddenInput()->label(false);?>
    <?= $form->field($model, 'vn')->hiddenInput()->label(false);?>
    <?= $form->field($model, 'pcc_vn')->hiddenInput()->label(false);?>
    <?= $form->field($model, 'cid')->hiddenInput(['id' => 'cid'])->label(false);?>

    <div class="row">
        <div class="col-xs-3 col-sm-3 col-md-3 col-lg-3">
            <?php
            echo $form->field($model, 'icode')->widget(Select2::classname(), [
                'data' => ArrayHelper::map(GatewayCDrugItems::find()->all(), 'icode', function($model, $defaultValue) {
                            return $model->drug_name.' '.$model->unit;
                        }),
                    'options' => [
                        'id' => 'icode',
                        
                         'placeholder' => 'รายการยา ...',
                         'class' => 'fires clear'
                        // 'onchange' => 'alert (this.value)'                         
                        ],
                    'pluginOptions' => [
                        'allowClear' => true,
                ],
                'pluginEvents' => [
                    "select2:select" => "function() { $('#druguse').select2('open'); }",
                 ]
            ])->label(false);
            ?>
        </div>

        <div class="col-xs-3 col-sm-3 col-md-3 col-lg-3">
<?php
//  $form->field($model, 'druguse')->widget(Select2::classname(), [
//                 'data' => ArrayHelper::map(GatewayCDruguage::find()->all(), 'drugusage', function($model, $defaultValue) {
//                             return $model->shortlist;
//                         }),
//                     'options' => [
//                         'id' => 'druguse', 
//                         'placeholder' => 'วิธีใช้ ...',
//                         // 'multiple' => true,
//                         'class' => ''
//                     ],
//                     'pluginOptions' => ['allowClear' => true,'maximumSelectionLength'=> 2,'tags' => true,],
//                 'pluginEvents' => [
//                     "select2:select" => "function() { $('#qty').focus(); }",
//                  ]
//             ])->label(false);
            ?> 
            <?php
                $druguse = empty($person->prefix_id) ? '' : GatewayCDruguage::findOne(['druguse' => $model->druguse])->shortlist;//กำหนดค่าเริ่มต้น
                echo $form->field($model, 'druguse')->widget(Select2::className(), [
                    'initValueText'=>$druguse,//กำหนดค่าเริ่มต้น
                    'options'=>['placeholder'=>'วิธีใช้'],
                    'pluginOptions'=>[
                        'allowClear'=>true,
                        'tags' => true,
                        'minimumInputLength'=>0,//ต้องพิมพ์อย่างน้อย 3 อักษร ajax จึงจะทำงาน
                        'ajax'=>[
                            'url'=>\yii\helpers\Url::to(['druguse-list']),
                            'dataType'=>'json',//รูปแบบการอ่านคือ json
                            'data'=>new JsExpression('function(params) { return {q:params.term};}')
                        ],
                        'escapeMarkup'=>new JsExpression('function(markup) { return markup;}'),
                        'templateResult'=>new JsExpression('function(prefix){ return prefix.text;}'),
                        'templateSelection'=>new JsExpression('function(prefix) {return prefix.text;}'),
                    ],
                    'pluginEvents' => [
                                            "select2:select" => "function() { $('#qty').focus(); }",
                                         ]
                ])->label(false);
                ?>
        </div>

        <div class="col-xs-2 col-sm-2 col-md-2 col-lg-2">
<?= $form->field($model, 'qty')->textInput(['id' => 'qty','placeholder' => 'จำนวน ...',])->label(false); ?>  
        </div>
        <div class="col-xs-2 col-sm-2 col-md-2 col-lg-2">
        <div style="margin-top:0px">
            <?php echo Html::submitButton('<i class="fa fa-plus"></i>', ['class' => 'btn btn-success','style' => 'margin-top:0px;margin-right:5px;']) ?>
<?=Html::a('<i class="fa fa-print"></i> พิมพ์ฉลากยา','../report/viewer.php?vn='.$model->pcc_vn.'&cid='.$model->cid,['class' => 'btn btn-info','target' => '_blank','style' => 'margin-top:0px;'])?>
       </div>
        </div>

        <div class="col-xs-1 col-sm-1 col-md-1 col-lg-1">
     <div class="total-price" style="margin-top:0px">
     <p id="totalprice"></p>
     </div>
            </div>
            
           
            
        </div>
    </div>
<?php ActiveForm::end(); ?>
</div>


<?php
$js = <<< JS
$(function(){
totalPrice($('#cid').val());
// $('#crud-medication-pjax').on('pjax:complete', function() {
//     $.pjax.reload({container: '#druguse-pjax'});
//              })
// $('#druguse').keypress(function(){
//     alert();
// });

// $('#druguse').on('keypress', '.select2', function (e) {
// //   if (e.originalEvent) {
// //     $(this).siblings('select').select2('open');    
//    } 

// });

// $('#druguse').select2({
//     noResults: function(query) {
//       return 'No results matching: ' + query;
//     }
//     });

// $('#druguse').addClass('select2 select2-container select2-container--krajee select2-container--focus');
    
// $('#druguse').select2({
//     tags: true,
//     insertTag: function(data, tag){
//         tag.text = "create: " + tag.text;
//         data.push(tag);
//     }	
// }).on('select2:select', function(){
//     if($(this).find("option:selected").data("select2-tag")==true) {
//         // some more stuff...
//     }
// });


// $("#druguse").on("change", function () { 
	
//     console.log($(this).val());
//     $.ajax({
//         type: "method",
//         url: "index.php?r=doctorworkbench%2Fpcc-medication/create-drugusage",
//         data:{data:$(this).val()},
//         dataType: "json",
//         success: function (response) {
            
//         }
//     });
//      });

// $('#druguse').select2({
//     placeholder: "Select or add tags",
//     tags: true,
//     tokenSeparators: [",", " "],
//     createTag: function(newTag) {
//         return {
//             id: 'new:' + newTag.term,
//             text: newTag.term + ' (new)'
//         };
//     }
// });

});
JS;
$this->registerJS($js);
?>

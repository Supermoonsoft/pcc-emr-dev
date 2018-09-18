<?php
use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use yii\bootstrap\ActiveForm;
use phpnt\ICheck\ICheck;
use kartik\datecontrol\DateControl;
use app\components\PatientHelper;
use app\components\MessageHelper;
use app\components\loading\ShowLoading;
use unclead\multipleinput\MultipleInput;
use kartik\widgets\Select2;
use yii\web\JsExpression;

// use Model
use app\modules\doctorworkbench\models\CIcd10tm;

$url = \yii\helpers\Url::to(['order/icd10-list']);//กำหนด URL ที่จะไปโหลดข้อมูล
$prefix = empty($person->prefix_id) ? '' : BasePrefix::findOne($model->prefix_id)->prefix_name;//กำหนดค่าเริ่มต้น
?>
<style>
.navbar-default .navbar-nav > li.dropdown:hover > a, 
.navbar-default .navbar-nav > li.dropdown:hover > a:hover,
.navbar-default .navbar-nav > li.dropdown:hover > a:focus {
    background-color: rgb(231, 231, 231);
    color: rgb(85, 85, 85);
}
li.dropdown:hover > .dropdown-menu {
    display: block;
	background-color: #eee;
}
.nav-tabs > li {
    background-color: #c7c7c7c7;
}
.nav-tabs > li > a {
    color:#353535;
}
.text-right{
    text-align: right;
}
.text-center{
    text-align: center;
}
.form-group {
    margin-bottom: -20px;
}

</style>
  <!-- start panel -->

 
<div class="panel panel-info" style="margin-left: 20px;margin-right: 20px">
	<div class="panel-heading">
		<div class="panel-title"><li class="fa fa-stethoscope"></li> Order</div>
	</div>
	<div class="panel-body">
<div class="row">
    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
		<!-- tabs -->
  <ul class="nav nav-tabs">
    <li class="active"><a data-toggle="tab" href="#diagnosis">Diganosis</a></li>
    <li><a data-toggle="tab" href="#medication">Medication</a></li>
    <li><a data-toggle="tab" href="#procedure">Procedure</a></li>
    <li><a data-toggle="tab" href="#appointment">Appointment</a></li>
  </ul>

  <div class="tab-content">
    <div id="diagnosis" class="tab-pane fade in active">
      <h3></h3>


<?php $form = \yii\bootstrap\ActiveForm::begin([
    'id'                        => 'diag-form',
    'enableAjaxValidation'      => true,
    'enableClientValidation'    => false,
    'validateOnChange'          => false,
    'validateOnSubmit'          => true,
    'validateOnBlur'            => false,
    'options' => [
        'enctype' => 'multipart/form-data'
    ]
]) ?>

<?= $form->field($model, 'diagnosis')->widget(MultipleInput::className(), [
    'max' => 4,
    'columns' => [
        [
            'name'  => 'icd10',
            'type'  => Select2::className(),
            'title' => 'ICD10',
            'enableError' => true,
            'options' => [
                'pluginOptions' => [
                    'placeholder'=>'ICD10',
                    'allowClear'=>true,
                    'minimumInputLength'=>1,//ต้องพิมพ์อย่างน้อย 3 อักษร ajax จึงจะทำงาน
                    'ajax'=>[
                        'url'=>$url,
                        'dataType'=>'json',//รูปแบบการอ่านคือ json
                        'data'=>new JsExpression('function(params) { return {q:params.term};}')
                    ],
                    'escapeMarkup'=>new JsExpression('function(markup) { return markup;}'),
                    'templateResult'=>new JsExpression('function(prefix){ return prefix.text;}'),
                    'templateSelection'=>new JsExpression('function(prefix) {return prefix.text;}'),
                ],
            ],
        ],
        // [
        //     'name'  => 'icd10',
        //     'title' => 'ชื่อโรค',
        //     'type'  => Select2::className(),
        //     'enableError' => true,
        //     // 'placeholder'=>'ICD10',
        //     'options' => [
        //         'pluginOptions' => ['placeholder'=>'Select',],
        //         'data' => ArrayHelper::map(CIcd10tm::find()->all(), 'diagcode','diagcode')
        //     ]
        //     ],
            [
                'name'  => 'icd10_name',
                'title' => 'ชื่อโรค',
                'enableError' => true,
                'options' => [
                    'class' => 'input-priority'
                ]
                ],
            [
                'name'  => 'type',
                'title' => 'ประเภท',
                'enableError' => true,
                'options' => [
                    'class' => 'input-priority'
                ]
                ],
        [
            'name'  => 'doctor',
            'title' => 'แพทย์',
            'enableError' => true,
            'options' => [
                'class' => 'input-priority'
            ]
        ]
    ]
 ])->label('');
?>
<?= Html::submitButton('บันทึก', ['class' => 'btn btn-success']);?>
<?php ActiveForm::end();?>
    </div>
    <div id="medication" class="tab-pane fade">
      <h3></h3>



<?php $form = \yii\bootstrap\ActiveForm::begin([
    'id'                        => 'medication-form',
    'enableAjaxValidation'      => true,
    'enableClientValidation'    => false,
    'validateOnChange'          => false,
    'validateOnSubmit'          => true,
    'validateOnBlur'            => false,
    'options' => [
        'enctype' => 'multipart/form-data'
    ]
]) ?>

<?= $form->field($model, 'medication')->widget(MultipleInput::className(), [
    'max' => 4,
    'columns' => [
        [
            'name'  => 'drug_items',
            'type'  => Select2::className(),
            'title' => 'ยา/บริการ',
            'defaultValue' => 1,
            'items' => [
                1 => 'ACTIFED .TAB',
                2 => 'ค่าบริการผู้ป่วยนอก ในเวลาราชการ'
            ]
        ],
        [
            'name'  => 'direction',
            'title' => 'วิิธีใช้',
            'enableError' => true,
            'options' => [
                'class' => 'input-priority'
            ]
            ],
            [
                'name'  => 'qty',
                'title' => 'จำนวน',
                'enableError' => true,
                'options' => [
                    'class' => 'input-priority'
                ]
                ],
        [
            'name'  => 'price',
            'title' => 'ราคา',
            'enableError' => true,
            'options' => [
                'class' => 'input-priority'
            ]
        ]
    ]
 ])->label('');
?>


<?= Html::submitButton('บันทึก', ['class' => 'btn btn-success']);?>
<?php ActiveForm::end();?>

    
    
    </div>
    <div id="procedure" class="tab-pane fade">
      <h3></h3>
    </div>
    <div id="appointment" class="tab-pane fade">
      <h3></h3>
    </div>
</div>
		<!-- /tabs -->

</div>
</div>
</div>
</div>
<!-- Panel -->
<!-- End panel  -->



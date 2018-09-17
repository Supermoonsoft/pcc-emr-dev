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
      <h3>Diagnosis</h3>


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
           // 'defaultValue' => 1,
            'items' => [
                1 => 'A001',
                2 => 'A002'
            ]
        ],
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
 ]);
?>
<?= Html::submitButton('บันทึก', ['class' => 'btn btn-success']);?>
<?php ActiveForm::end();?>
    </div>
    <div id="medication" class="tab-pane fade">
      <h3>Medication</h3>


<?php $form = \yii\bootstrap\ActiveForm::begin([
    'id'                        => '-form',
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
 ]);
?>


<?= Html::submitButton('บันทึก', ['class' => 'btn btn-success']);?>
<?php ActiveForm::end();?>

    
    </div>
    <div id="procedure" class="tab-pane fade">
      <h3>Procedure</h3>
    </div>
    <div id="appointment" class="tab-pane fade">
      <h3>Appointment</h3>
    </div>
</div>
		<!-- /tabs -->

</div>
</div>
</div>
</div>
<!-- Panel -->
<!-- End panel  -->


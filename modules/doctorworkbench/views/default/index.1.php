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
		<div class="panel-title"><span class="glyphicon glyphicon-edit"></span> ระบบห้องตรวจแพทย์</div>
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
    'id'                        => 'tabular-form',
    'enableAjaxValidation'      => true,
    'enableClientValidation'    => false,
    'validateOnChange'          => false,
    'validateOnSubmit'          => true,
    'validateOnBlur'            => false,
    'options' => [
        'enctype' => 'multipart/form-data'
    ]
]) ?>

<?= $form->field($model, 'schedule')->widget(MultipleInput::className(), [
    'max' => 4,
    'columns' => [
        [
            'name'  => 'user_id',
            'type'  => 'dropDownList',
            'title' => 'ICD10',
            'defaultValue' => 1,
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
<hr>

      <form class="form-inline">
  <div class="form-group">
    <label class="sr-only" for="exampleInputAmount">Amount (in dollars)</label>
    <div class="input-group">
      <input type="text" class="form-control" id="exampleInputAmount" placeholder="Amount">
      <div class="input-group-addon">ICD10</div>
    </div>
  </div>
  <button type="submit" class="btn btn-primary"><span class="glyphicon glyphicon-plus"></span> เพิ่ม</button>
</form>

      <table class="table table-bordered">
    <thead>
        <tr>
            <td class="text-center" width="5%" style="text-align:left;">ลำดับ</td>
            <td class="text-center" width="8%" style="text-align:left;">Dx. ICD10</td>
            <td class="text-center" width="30%" style="text-align:left;">ชื่อโรค</td>
            <td class="text-center" width="15%" style="text-align:left;">ประเภท</td>
            <td class="text-center" width="15%" style="text-align:left;">แพทย์</td>
        </tr>
    </thead>
    <tbody>
    <tr>
            <td class="text-right">1</td>
            <td>A001</td>
            <td>xxxxxxxxxx</td>
            <td>xx</td>
            <td>นายแพทย์ xxxxx xxxxx</td>
    </tr>
    </tbody>
    </table>

    </div>
    <div id="medication" class="tab-pane fade">
      <h3>Medication</h3>
      <form class="form-inline">
  <div class="form-group">
    <label class="sr-only" for="">ยา/บริการ</label>
    <input type="text" class="form-control" placeholder="ยา/บริการ">
  </div>
  <div class="form-group">
    <label class="sr-only" for="">จำนวน</label>
    <input type="text" class="form-control" placeholder="จำนวน">
  </div>
  <button type="submit" class="btn btn-primary"><span class="glyphicon glyphicon-plus"></span> เพิ่ม</button>
</form>
      <table class="table table-bordered">
    <thead>
        <tr>
            <td class="text-center" width="5%" style="text-align:left;">ลำดับ</td>
            <td class="text-center" width="40%" style="text-align:left;">ยา/บริการ</td>
            <td class="text-center" width="40%" style="text-align:left;">วิิธีใช้</td>
            <td class="text-center" width="10%" style="text-align:left;">จำนวน</td>
            <td class="text-center" width="5%" style="text-align:left;">ราคา</td>
        </tr>
    </thead>
    <tbody>
    <tr>
            <td class="text-right">1</td>
            <td>ACTEIFED. TAB</td>
            <td>xxxxxxxxxx</td>
            <td>5</td>
            <td>10</td>
    </tr>
    </tbody>
    </table>
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



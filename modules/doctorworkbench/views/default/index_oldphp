<?php
use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use yii\bootstrap\ActiveForm;
use phpnt\ICheck\ICheck;
use kartik\datecontrol\DateControl;
use app\components\PatientHelper;
use app\components\MessageHelper;
use app\components\loading\ShowLoading;
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
/* .form-horizontal .control-label {
    padding-top: 7px;
    margin-bottom: 0;
    text-align: right;
}
.field-doctorworkbench-hn{
    display: inline-block;
    padding-left: 10px;
    margin-bottom: -10px;
    }
.field-doctorworkbench-fullname{
    display: inline-block;
    margin-bottom: -10px;
    }
.field-doctorworkbench-age{
    display: inline-block;
    margin-bottom: -10px;
    padding-left: 10px;
    }
.field-doctorworkbench-age{display: inline-block;} */
</style>
  <!-- start panel -->

 
<div class="panel panel-info" style="margin-left: 20px;margin-right: 20px">
	<div class="panel-heading">
		<div class="panel-title"><span class="fa fa-wheelchair"></span> ระบบห้องตรวจแพทย์</div>
	</div>
	<div class="panel-body">
    <?php $form = ActiveForm::begin([
      'id' => 'form',
      'layout' => 'horizontal',
      'fieldConfig' => [
        'template' => "{label}\n{beginWrapper}\n{input}\n{hint}\n{error}\n{endWrapper}",
        'horizontalCssClasses' => [
            'label' => 'col-sm-3',
            'offset' => 'offset-sm-4',
            'wrapper' => 'col-sm-8',
            'error' => '',
            'hint' => '',
        ],
    ],
      ]); ?>

      
      <div class="row">
          <div class="col-xs-4 col-sm-4 col-md-4 col-lg-4">
    <?= $form->field($model, 'fullname')->textInput(['value' => 'นายปัจวัฒน์ ศรีบุญเรือง','disabled' => true])?><br>
    <?= $form->field($model, 'age')->textInput(['value' => 33,'style' => 'width:80%;','disabled' => true]);?>
    <?= $form->field($model, 'claim')->textInput(['value' => ''])?>
              
          </div>
          <div class="col-xs-4 col-sm-4 col-md-4 col-lg-4">
    <?= $form->field($model, 'department')->textInput(['value' => ''])?>
    <?= $form->field($model, 'hn')->textInput(['value' => 00001])?>

              
              </div>
              <div class="col-xs-4 col-sm-4 col-md-4 col-lg-4">

              </div>
      </div>

<?php $form = ActiveForm::end(); ?>
<br><br>
<div class="row">
<div class="col-xs-2 col-sm-2 col-md-2 col-lg-2">
    <table class="table table-bordered">
    <thead>
        <tr>
            <td class="text-center">V/S</td>
            <td class="text-center">Value</td>
        </tr>
    </thead>
    <tbody>
    <tr>
            <td class="text-right">BP</td>
            <td>120/80</td>
    </tr>
    <tr>
            <td class="text-right">BW</td>
            <td>50 Kg.</td>
    </tr>
    <tr>
            <td class="text-right">Heifht</td>
            <td>150 Cm.</td>
    </tr>
    <tr>
            <td class="text-right">Temp</td>
            <td>30 C</td>
    </tr>
    <tr>
            <td class="text-right">RR</td>
            <td>20</td>
    </tr>
    <tr>
            <td class="text-right">BMI</td>
            <td>2.22</td>
    </tr>
    </tbody>
    </table>
        </div>
    <!-- end col 2 -->
    <div class="col-xs-5 col-sm-5 col-md-5 col-lg-5">
    <!-- <div class="callout callout-danger">
                  <h5>CC</h5>
                  <p>ปวดหัว ตัวร้อน มีน้ำมูกไหล</p>
        </div> -->
        <?php // echo $form->field($model, 'cc')->textArea(['cols' => 100,'rows' => 5])->label(false);?>
        
    
    </div>
    <!-- End col 5 -->
    <div class="col-xs-5 col-sm-5 col-md-5 col-lg-5">
   

    </div>
</div>
<hr>

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
    </div>
    <div id="medication" class="tab-pane fade">
      <h3>Medication</h3>
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



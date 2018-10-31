
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
<!-- <link href="https://fonts.googleapis.com/css?family=Kanit:300|Mitr:300" rel="stylesheet"> -->
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
    background-color: #eee;
}
.nav-tabs > li > a {
    color:#353535;
    margin-right: -1px;
}
.text-right{
    text-align: right;
}
.text-center{
    text-align: center;
}
/* .form-group {
    margin-bottom: -20px;
} */

</style>
  <!-- start panel -->


<div class="row">
    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
		<!-- tabs -->
  <ul class="nav nav-tabs">
  <li class="<?=$emr;?>"><?=Html::a('<i class="far fa-hospital"></i> EMR', ['/doctorworkbench/order/emr'])?></li>    
  <li class="<?=$lab;?>"><?=Html::a('<i class="fas fa-flask"></i> Lab History', ['/doctorworkbench/order/lab'])?></li> 
  <li class="<?=$drug;?>"><?=Html::a('<i class="fas fa-prescription"></i> Drug History', ['/doctorworkbench/order/drug'])?></li>  
  <li class="<?=$cc;?>"><?=Html::a('<i class="fas fa-universal-access"></i> CC', ['/doctorworkbench/order/cc'])?></li>    
  <li class="<?=$pi;?>"><?=Html::a('<i class="fas fa-file-alt"></i> VS', ['/doctorworkbench/order/pi'])?></li>    
  <li class="<?=$pe;?>"><?=Html::a('<i class="fas fa-street-view"></i> PE', ['/doctorworkbench/order/pe'])?></li>    
    <li class="<?=$diagnosis;?>"><?=Html::a('<i class="fas fa-user-md"></i> Diganosis', ['/doctorworkbench/pcc-diagnosis'])?></li>
    <li class="<?=$medication;?>"><?=Html::a('<i class="fas fa-pills"></i> Medication', ['/doctorworkbench/pcc-medication'])?></li>
    <li class="<?=$procedure;?>"><?=Html::a('<i class="fas fa-diagnoses"></i> Procedure', ['/doctorworkbench/pcc-procedure'])?></li>
    <li class="<?=$pre_order_lab;?>"><?=Html::a('<i class="fas fa-vial"></i> Pre-Order Lab', ['/doctorworkbench/order/pre-order-lab'])?></li>
    <li class="<?=$apointment;?>"><?=Html::a('<i class="far fa-calendar-check"></i> Appointment', ['/doctorworkbench/order/appointment'])?></li>
    <li class="<?=$treatmment_plan;?>"><?=Html::a('<i class="far fa-paper-plane"></i> Treatment Plan', ['/doctorworkbench/order/treatmment-plan'])?></li>    
    <li class="<?=$education;?>"><?=Html::a('<i class="fas fa-graduation-cap"></i> Education', ['/doctorworkbench/order/education'])?></li>    
  
  </ul>

  <div class="tab-content">
  <br>
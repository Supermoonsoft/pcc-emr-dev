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
use kartik\tabs\TabsX;
use yii\helpers\Url;


// use Model
use app\modules\doctorworkbench\models\CIcd10tm;

$url = \yii\helpers\Url::to(['order/icd10-list']);//กำหนด URL ที่จะไปโหลดข้อมูล
$prefix = empty($person->prefix_id) ? '' : BasePrefix::findOne($model->prefix_id)->prefix_name;//กำหนดค่าเริ่มต้น
// $this->registerJS($this->render('../../dist/js/loadDataToTabs.js'));
// $this->registerJS($this->render('../../dist/js/script.js'));

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
<?php

$items = [
    [
        'label'=>'<i class="glyphicon glyphicon-home"></i> Diganosis',
        // 'content'=>$this->render('../pcc-diagnosis/index',[
        //     'model' => $modelPccDiagnosis,
        //     'searchModel' => $searchModelPccDiagnosis,
        //     'dataProvider' => $dataProviderPccDiagnosis,
        // ]),
        // 'content' =>$this->render('../pcc-diagnosis/create',[
        //     'model' => $modelPccDiagnosis
        // ])
        'content'=> '<div id="diagnosis_show"></div>
        ',
        'active'=>true,
    ],
    [
        'label'=>'<i class="glyphicon glyphicon-user"></i> Medication',
        'content'=>'xxx',
        'options' => ['id' => 'tab2'],
    ],
    [
        'label'=>'<i class="glyphicon glyphicon-user"></i> Procedure',
        'content'=>'',
        'options' => ['id' => 'tab3'],
    ],
    [
        'label'=>'<i class="glyphicon glyphicon-user"></i> Appointment',
        'content'=>'',
        'options' => ['id' => 'tab4'],
    ],

];
// Ajax Tabs Above
echo TabsX::widget([
    'items'=>$items,
    'position'=>TabsX::POS_ABOVE,
    'encodeLabels'=>false
]);
?>
</div>
</div>

<?php
$js = <<< JS
$(function(){
    loadDiagnosis();

});

function loadDiagnosis(){
    $.ajax({
        type: "get",
        url:'index.php?r=doctorworkbench/pcc-diagnosis/create',
        // dataType: "json",
        success: function (response) {
            $('#diagnosis_show').html(response);
        }
    });

}
JS;
$this->registerJS($js);
?>



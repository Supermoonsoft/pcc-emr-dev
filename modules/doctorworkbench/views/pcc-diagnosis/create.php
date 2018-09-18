<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\modules\doctorworkbench\models\PccDiagnosis */

$this->title = 'Create Pcc Diagnosis';
$this->params['breadcrumbs'][] = ['label' => 'Pcc Diagnoses', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="pcc-diagnosis-create">
    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>
<div id="diagnosis_table"></div>
</div>

<?php
$js = <<< JS
$(function(){
loadDiagnosis();
$('#icd_code').change(function(){
    $.ajax({
        url:'index.php?r=doctorworkbench/pcc-diagnosis/save',
        method:'post',
        data: {icd_code : $(this).val()},
        dataType:'json',
        success: function(){
           loadDiagnosis();
        }
    });
    
});

});

function loadDiagnosis(){
    $.ajax({
        type: "get",
        url:'index.php?r=doctorworkbench/pcc-diagnosis',
        // dataType: "json",
        success: function (response) {
            $('#diagnosis_table').html(response);
        }
    });

}
JS;
$this->registerJS($js);
?>

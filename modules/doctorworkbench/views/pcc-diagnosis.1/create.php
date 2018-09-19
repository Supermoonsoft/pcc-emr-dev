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

$('#icd_code').change(function(){
var form = $('#form-diagnosis');

var formData = form.serialize();
    $.ajax({
        url:'index.php?r=doctorworkbench/pcc-diagnosis/save',
        method:'post',
        data: {icd_code : $(this).val()},
        dataType:'json',
        success: function(){
            $.pjax.reload({container:"#diag-grid"});
        },
        error: function () {
        alert("Something went wrong");
    }
    });
    
});
});

JS;
$this->registerJS($js);
?>

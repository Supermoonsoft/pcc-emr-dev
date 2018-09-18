<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\widgets\Select2;
use yii\helpers\ArrayHelper;
use app\modules\doctorworkbench\models\CDrugitems;
?>

<div class="pcc-medication-form" style="margin-bottom:20px;">
<?php 
    $form = ActiveForm::begin([
        'id' => 'form',
        'action' => ['create'],
        'options' => [
            'data-pjax' => 1
        ],
    ]); 
    ?>
    <?= $form->field($model, 'hn')->hiddenInput(['value' => 0000001])->label(false);?>
    <?= $form->field($model, 'vn')->hiddenInput(['value' => 8888444])->label(false);?>


<div class="row">

    <div class="col-xs-3 col-sm-3 col-md-3 col-lg-3">
    <?php echo $form->field($model, 'icode')->widget(Select2::classname(), [
    'data' => ArrayHelper::map(CDrugitems::find()->all(),'icode', 'name'),
    'options' => ['id' => 'icode','placeholder' => 'Select Drug ...'],
    'pluginOptions' => [
        'allowClear' => true
    ],
]);?>
    </div>

    <div class="col-xs-3 col-sm-3 col-md-3 col-lg-3">
    <?= $form->field($model, 'qty')->textInput(['id' => 'qty']) ?>  
    </div>
    
    <div class="col-xs-2 col-sm-2 col-md-2 col-lg-2">
    
    </div>
</div>

    <?php ActiveForm::end(); ?>
    
</div>

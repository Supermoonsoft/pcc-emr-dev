<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\datecontrol\DateControl;
use yii\helpers\ArrayHelper;
use kartik\widgets\Select2;
use app\modules\queuemanage\models\CClinic;

?>

<div class="pcc-visit-search">

    <?php $form = ActiveForm::begin([
        'action' => ['default/view-all'],
        'method' => 'get',
        'options' => [
            'data-pjax' => 1
        ],
    ]); ?>
    <b>
รับเข้าบริการระหว่าง    
    </b>
<div class="row">

    
    <div class="col-xs-3 col-sm-3 col-md-3 col-lg-3">
    <?=$form->field($model, 'date1')->widget(DateControl::classname(), [
    'type'=>DateControl::FORMAT_DATE,
    'ajaxConversion'=>false,
    'widgetOptions' => [
        'pluginOptions' => [
            'autoclose' => true
        ]
    ]
])->label(false);?>
        
    </div>
    <div class="col-xs-3 col-sm-3 col-md-3 col-lg-3">
    <?=$form->field($model, 'date2')->widget(DateControl::classname(), [
    'type'=>DateControl::FORMAT_DATE,
    'ajaxConversion'=>false,
    'widgetOptions' => [
        'pluginOptions' => [
            'autoclose' => true
        ]
    ]
])->label(false);?>
     </div>
     <div class="col-xs-4 col-sm-4 col-md-4 col-lg-4">
     <?= $form->field($model, 'visit_department')->widget(Select2::classname(), [
                'data' => ArrayHelper::map(CClinic::find()->all(), 'code','name'),
                    'options' => [
                        'id' => 'visit_department', 
                        'placeholder' => 'เลือกคลินิก...',
                    ],
                    'pluginOptions' => ['allowClear' => true],
                'pluginEvents' => [
                    "select2:select" => "function() {}",
                 ]
            ])->label(false);
            ?> 
    
     </div>
     
     <div class="col-xs-2 col-sm-2 col-md-2 col-lg-2">
     <div class="form-group">
        <?= Html::submitButton('<i class="fas fa-search"></i> ตกลง', ['class' => 'btn btn-danger']) ?>
    </div>
     </div>
     
    
</div>



    <?php ActiveForm::end(); ?>

</div>

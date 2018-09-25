<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\modules\appointment\models\GatewayEmrAppointment */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="gateway-emr-appointment-form">

    <?php $form = ActiveForm::begin(); ?>


    <?= $form->field($model, 'id')->hiddenInput(['value' => NULL])->label(FALSE) ?>
    <?= $form->field($model, 'provider_code')->hiddenInput(['value' => NULL])->label(FALSE) ?>
    <?= $form->field($model, 'provider_name')->hiddenInput(['value' => NULL])->label(FALSE) ?>
    <?= $form->field($model, 'hn')->hiddenInput(['value' => NULL])->label(FALSE) ?>
    <?= $form->field($model, 'vn')->hiddenInput(['value' => NULL])->label(FALSE) ?>
    <?= $form->field($model, 'an')->hiddenInput(['value' => NULL])->label(FALSE) ?>
    <?= $form->field($model, 'date_visit')->hiddenInput(['value' => date('Y-m-d')])->label(FALSE) ?>
    <?= $form->field($model, 'time_visit')->hiddenInput(['value' => date('H:m:s')])->label(FALSE) ?>
    <?= $form->field($model, 'data_json')->hiddenInput(['value' => NULL])->label(FALSE) ?>
    <?= $form->field($model, 'last_update')->hiddenInput(['value' => NULL])->label(FALSE) ?>

    <div style="margin:20px">
        <div class="row">
            <div class="col-md-12">
                <?= $form->field($model, 'appoint_date')->textInput() ?>
            </div>
        </div>

        <div class="row" style="margin-top: 10px">
            <div class="col-md-12">
                <?= $form->field($model, 'appoint_time')->textInput() ?>
            </div>
        </div>
        <div class="row" style="margin-top: 10px">
            <div class="col-md-12">
                <?= $form->field($model, 'clinic')->textInput() ?>
            </div>
        </div>
        <div class="row" style="margin-top: 10px">
            <div class="col-md-12">
                <?= $form->field($model, 'appoint_detail')->textInput() ?>
            </div>
        </div>
         <div class="row" style="margin-top: 10px">
            <div class="col-md-12">
                <?= $form->field($model, 'appoint_doctor')->textInput() ?>
            </div>
        </div>

        <div class="row" style="margin-top: 20px;margin-bottom: 50px">
            <div class="col-md-12">
                <div class="form-group">
                    <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
                </div>
            </div>
        </div>
    </div>

    <?php ActiveForm::end(); ?>

</div>

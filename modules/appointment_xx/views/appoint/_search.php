<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\modules\appointment\models\GatewayEmrAppointmentSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="gateway-emr-appointment-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
        'options' => [
            'data-pjax' => 1
        ],
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'provider_code') ?>

    <?= $form->field($model, 'provider_name') ?>

    <?= $form->field($model, 'hn') ?>

    <?= $form->field($model, 'vn') ?>

    <?php // echo $form->field($model, 'an') ?>

    <?php // echo $form->field($model, 'date_visit') ?>

    <?php // echo $form->field($model, 'time_visit') ?>

    <?php // echo $form->field($model, 'clinic') ?>

    <?php // echo $form->field($model, 'appoint_date') ?>

    <?php // echo $form->field($model, 'appoint_time') ?>

    <?php // echo $form->field($model, 'appoint_detail') ?>

    <?php // echo $form->field($model, 'data_json') ?>

    <?php // echo $form->field($model, 'last_update') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

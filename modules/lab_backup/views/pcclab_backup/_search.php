<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\modules\lab\models\PcclabSeach */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="pcclab-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
        'options' => [
            'data-pjax' => 1
        ],
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'hn') ?>

    <?= $form->field($model, 'vn') ?>

    <?= $form->field($model, 'provider_code') ?>

    <?= $form->field($model, 'provider_name') ?>

    <?php // echo $form->field($model, 'date_service') ?>

    <?php // echo $form->field($model, 'time_service') ?>

    <?php // echo $form->field($model, 'lab_code') ?>

    <?php // echo $form->field($model, 'lab_name') ?>

    <?php // echo $form->field($model, 'standard_result') ?>

    <?php // echo $form->field($model, 'lab_request_at') ?>

    <?php // echo $form->field($model, 'lab_result_at') ?>

    <?php // echo $form->field($model, 'data_json') ?>

    <?php // echo $form->field($model, 'last_update') ?>

    <?php // echo $form->field($model, 'lab_result') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

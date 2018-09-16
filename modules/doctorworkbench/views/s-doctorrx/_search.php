<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\modules\doctorworkbench\models\SDoctorrxSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="sdoctorrx-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'vn') ?>

    <?= $form->field($model, 'hn') ?>

    <?= $form->field($model, 'an') ?>

    <?= $form->field($model, 'vstdate') ?>

    <?php // echo $form->field($model, 'vsttime') ?>

    <?php // echo $form->field($model, 'drugcode') ?>

    <?php // echo $form->field($model, 'use_id') ?>

    <?php // echo $form->field($model, 'qty') ?>

    <?php // echo $form->field($model, 'unitprice') ?>

    <?php // echo $form->field($model, 'costprice') ?>

    <?php // echo $form->field($model, 'totalprice') ?>

    <?php // echo $form->field($model, 'userid_doctor') ?>

    <?php // echo $form->field($model, 'data_json') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

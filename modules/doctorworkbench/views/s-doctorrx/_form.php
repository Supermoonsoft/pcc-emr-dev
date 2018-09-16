<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\modules\doctorworkbench\models\SDoctorrx */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="sdoctorrx-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'id')->textInput() ?>

    <?= $form->field($model, 'vn')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'hn')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'an')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'vstdate')->textInput() ?>

    <?= $form->field($model, 'vsttime')->textInput() ?>

    <?= $form->field($model, 'drugcode')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'use_id')->textInput() ?>

    <?= $form->field($model, 'qty')->textInput() ?>

    <?= $form->field($model, 'unitprice')->textInput() ?>

    <?= $form->field($model, 'costprice')->textInput() ?>

    <?= $form->field($model, 'totalprice')->textInput() ?>

    <?= $form->field($model, 'userid_doctor')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'data_json')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

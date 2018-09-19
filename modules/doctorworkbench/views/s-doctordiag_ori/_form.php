<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\modules\doctorworkbench\models\SDoctordiag */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="sdoctordiag-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'id')->textInput() ?>

    <?= $form->field($model, 'vn')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'hn')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'vstdate')->textInput() ?>

    <?= $form->field($model, 'vsttime')->textInput() ?>

    <?= $form->field($model, 'diagtype')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'diagcode')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'icd10')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'userid_doctor')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'data_json')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

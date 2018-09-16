<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\modules\doctorworkbench\models\SDoctordiagSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="sdoctordiag-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'vn') ?>

    <?= $form->field($model, 'hn') ?>

    <?= $form->field($model, 'vstdate') ?>

    <?= $form->field($model, 'vsttime') ?>

    <?php // echo $form->field($model, 'diagtype') ?>

    <?php // echo $form->field($model, 'diagcode') ?>

    <?php // echo $form->field($model, 'icd10') ?>

    <?php // echo $form->field($model, 'userid_doctor') ?>

    <?php // echo $form->field($model, 'data_json') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

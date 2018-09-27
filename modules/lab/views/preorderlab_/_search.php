<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\modules\lab\models\PreorderlabSeach */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="preorderlab-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
        'options' => [
            'data-pjax' => 1
        ],
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'cid') ?>

    <?= $form->field($model, 'hos_hn') ?>

    <?= $form->field($model, 'hos_vn') ?>

    <?= $form->field($model, 'hos_date_visit') ?>

    <?php // echo $form->field($model, 'lab_code_hos') ?>

    <?php // echo $form->field($model, 'lab_code_moph') ?>

    <?php // echo $form->field($model, 'lab_name_hos') ?>

    <?php // echo $form->field($model, 'request_at') ?>

    <?php // echo $form->field($model, 'result_at') ?>

    <?php // echo $form->field($model, 'data_json') ?>

    <?php // echo $form->field($model, 'lab_name_moph') ?>

    <?php // echo $form->field($model, 'hos_result') ?>

    <?php // echo $form->field($model, 'lab_normal') ?>

    <?php // echo $form->field($model, 'lab_possible') ?>

    <?php // echo $form->field($model, 'lab_range_min') ?>

    <?php // echo $form->field($model, 'lab_range_max') ?>

    <?php // echo $form->field($model, 'lab_range_female_min') ?>

    <?php // echo $form->field($model, 'lab_range_female_max') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

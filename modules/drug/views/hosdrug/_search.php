<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\modules\drug\models\HosdrugSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="hosdrug-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
        'options' => [
            'data-pjax' => 1
        ],
    ]); ?>

<div class="row"><div class="col-md-12">
<?= $form->field($model, 'cid') ?>
</div></div>

    <?php // echo $form->field($model, 'drug_code_hos') ?>

    <?php // echo $form->field($model, 'drug_name_hos') ?>

    <?php // echo $form->field($model, 'drug_pay_amount') ?>

    <?php // echo $form->field($model, 'drug_pay_unit') ?>

    <?php // echo $form->field($model, 'data_json') ?>

    <?php // echo $form->field($model, 'drug_code_moph') ?>

    <?php // echo $form->field($model, 'drug_name_moph') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

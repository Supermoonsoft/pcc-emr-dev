<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\modules\lab\models\HoslabSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="hoslab-search">

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
    

    <?php // echo $form->field($model, 'lab_code_hos') ?>

    <?php // echo $form->field($model, 'lab_code_moph') ?>

    <?php // echo $form->field($model, 'lab_name_hos') ?>

    <?php // echo $form->field($model, 'request_at') ?>

    <?php // echo $form->field($model, 'result_at') ?>

    <?php // echo $form->field($model, 'data_json') ?>

    <?php // echo $form->field($model, 'lab_name_moph') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

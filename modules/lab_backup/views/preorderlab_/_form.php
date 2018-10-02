<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use wbraganca\dynamicform\DynamicFormWidget;
use yii\widgets\Pjax;
use app\components\DbHelper;
use yii\web\JsExpression;
use app\components\loading\ShowLoading;
use yii\helpers\Url;
?>
<?php
$this->registerJs('')
?>
<div class="preorderlab-form">

    <?php $form = ActiveForm::begin(['id' => 'dynamic-form']); ?>
            <div class="row">
                <div class="col-sm-3">
                    <?= $form->field($model, "request_at")->textInput(['type' => 'date']) ?>
                </div>
                <div class="col-sm-3">
                    <?= $form->field($model, "lab_name_hos")->textInput(['maxlength' => true]) ?>
                </div>
                <div class="col-sm-3">
                    <?= $form->field($model, "result_at")->textInput(['tyep' => 'date']) ?>
                </div>
                <div class="col-sm-3">
                    <?= $form->field($model, "hos_result")->textInput(['maxlength' => true]) ?>
                </div>
            </div><!-- .row -->



    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

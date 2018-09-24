<?php
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;;
use yii\data\ActiveDataProvider;
use kartik\datecontrol\DateControl;
use kartik\select2\Select2;
use yii\helpers\ArrayHelper;

/* @var $this yii\web\View */
/* @var $model app\models\Users */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="users-form">
<style>
.form-group {
  margin-bottom: 0px;
}
.help-block {
    display: block;
    margin-top: 1px;
    margin-bottom: 1px;
    color: #737373;
}
.input-group {
    margin-bottom: 1px;
}
/*.col-sm-offset-1 {
    margin-left: 1%;
}*/
.modal.in .modal-dialog {
    width: 50%;
}
</style>
        <?php $form = ActiveForm::begin([
    'fieldConfig' => [
        'horizontalCssClasses' => [
            'label' => 'col-md-3',         
            'wrapper' => 'col-md-8'
        ]
    ],
    'layout' => 'horizontal'
]);?>

    <?= $form->field($model, 'username')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'email')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'password_hash')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'auth_key')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'confirmed_at')->textInput() ?>

    <?= $form->field($model, 'unconfirmed_email')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'blocked_at')->textInput() ?>

    <?= $form->field($model, 'registration_ip')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'created_at')->textInput() ?>

    <?= $form->field($model, 'updated_at')->textInput() ?>

    <?= $form->field($model, 'flags')->textInput() ?>

    <?= $form->field($model, 'last_login_at')->textInput() ?>

    <?= $form->field($model, 'status')->textInput() ?>

    <?= $form->field($model, 'password_reset_token')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'pname')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'dep_id')->textInput() ?>

    <?= $form->field($model, 'occ_id')->textInput() ?>

    <?= $form->field($model, 'occ_no')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'pos_id')->textInput() ?>

    <?= $form->field($model, 'pos_no')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'role')->textInput(['maxlength' => true]) ?>

  
	<?php if (!Yii::$app->request->isAjax){ ?>
	  	<div class="form-group">
	        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
	    </div>
	<?php } ?>

    <?php ActiveForm::end(); ?>
    
</div>

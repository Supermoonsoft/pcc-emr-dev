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

   <?= $form->field($model, 'username')->label('รหัสผู้ใช้')->textInput(['maxlength' => true,'readonly'=>true]) ?>

    <?= $form->field($model, 'email')->label('อิเมล์')->textInput(['maxlength' => true,'readonly'=>true]) ?>
  
    <?= $form->field($model, 'pname')->inline()->radioList(['นาย'=>'นาย','นาง'=>'นาง','นางสาว'=>'นางสาว']) ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>
    <?= $form->field($model, 'occ_no')->textInput(['maxlength' => true]) ?>
    

    <?php //echo  $form->field($model, 'dep_id')->textInput() ?>

    <?php //echo  $form->field($model, 'occ_id')->textInput() ?>

    <?php //echo  $form->field($model, 'occ_no')->textInput(['maxlength' => true]) ?>

    <?php //echo  $form->field($model, 'pos_id')->textInput() ?>

    <?php //echo  $form->field($model, 'pos_no')->textInput(['maxlength' => true]) ?>
<hr/>
    <?= $form->field($model, 'hospcode')->textInput(['maxlength' => true])->label('สถานบริการ') ?>
    <?= $form->field($model, 'role')->dropDownList(
            [10=>'admin',20=>'doctor',30=>'nurse',40=>'phar',50=>'dent',60=>'sasuk'],
            ['prompt'=>'ระดับผู้ใช้งาน']        
            )->label('ระดับผู้ใช้งาน') ?>

   <?php //echo $form->field($model, 'status')->textInput() ?>
	<?php if (!Yii::$app->request->isAjax){ ?>
	  	<div class="form-group">
	        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
	    </div>
	<?php } ?>

    <?php ActiveForm::end(); ?>
    
</div>
<?php
$js = <<< JS
$.fn.modal.Constructor.prototype.enforceFocus = function() {};        
      

JS;
$this->registerJS($js);
?>
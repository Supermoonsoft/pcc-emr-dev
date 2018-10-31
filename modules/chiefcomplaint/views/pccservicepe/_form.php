<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use froala\froalaeditor\FroalaEditor;
use froala\froalaeditor\FroalaEditorWidget;
use yii\widgets\Pjax;
use kartik\grid\GridView;
/* @var $this yii\web\View */
/* @var $model app\modules\chiefcomplaint\models\Pccservicepi */
/* @var $form yii\widgets\ActiveForm */

$this->registerJs($this->render('../../dist/js/script.js'));
$this->registerCss($this->render('../../dist/css/style.css'));
?>
<?php
$this->registerCss("

.cctext{
    font-size: 20px;
    margin-left:-7px;
   
}
.control-label{
//color:red;
}



");



?>


<!--- DIALOG 1--->
<div class="modal fade bd-popup1-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title" id="popup1ModalLabel">image1
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button></h3>
            </div>
            <div class="modal-body">
                <img id="edit" class="fr-fil fr-dib" src="../modules/chiefcomplaint/assets/body.jpg"/>
            </div>
            <div class="modal-footer">
                <input type="button" id="btnsave-tmpcc1" class="btn btn-primary" data-dismiss="modal" value="OK" >
            </div>
        </div>
    </div>
</div>

<div class="col-md-6">

    <fieldset>
        <legend class="scheduler-border"><i class="fas fa-street-view" ></i> PE Form 

            <button class="btn btn-pink" data-toggle="modal" data-target =".bd-popup1-modal-lg"> image1 </button>
            <button class="btn btn-pink" data-toggle="modal" data-target =".bd-popup2-modal-lg"> image2 </button>
            <button class="btn btn-pink" data-toggle="modal" data-target =".bd-popup3-modal-lg"> image3 </button>

        </legend> 

        
        
        
         <?php Pjax::begin(); ?>
        <?php $form = ActiveForm::begin(['id' => 'form-cc', 'action' => ['/chiefcomplaint/pccservicepe/create'], 'options' => ['data-pjax' => 1],]); ?>
        <div class="row"> 
            <div class="col-md-12" style="margin-top:10px">
                <?= $form->field($model, 'pe_text')->textarea(['id' => 'pe_text', 'class' => 'form-control cctext', 'rows' => 6]) ?>
            </div> 
        </div><!--- END ROW--->

        <div class="form-group" style="text-align:right;margin-right: 10px">
             <?php echo Html::submitButton('<i class="fa fa-plus"></i> บันทึก', ['class' => 'btn btn-success', 'id' => 'btn-save']) ?>
        </div>

        <?php ActiveForm::end(); ?>
        <?php Pjax::end(); ?>





    </fieldset>

</div>

<?php
$columns = [
    [
        'class' => 'kartik\grid\SerialColumn',
        'width' => '30px',
    ],
    [
        'class' => '\kartik\grid\DataColumn',
        'width' => '150px',
        'attribute' => 'date_service',
        'value' => function($model) {
            return $model->date_service.' '.$model->time_service;
        }
    ],
    [
        'class' => '\kartik\grid\DataColumn',
        //'width' => '200px',
        'attribute' => 'pe_text',
        'value' => function($model) {
            return $model->pe_text;
        }
    ],
    
];
?>

<div class="col-md-6">

    <fieldset style="margin-top:8px">
        <legend class="scheduler-border"><i class="fas fa-universal-access"></i> ประวัติ PE

        </legend> 
        <div style="margin-top: 10px;margin-right: 7px;margin-left: -10px">
        <?=
        GridView::widget([
            'id' => 'crud-pe',
            'dataProvider' => $dataProvider,
            'pjax' => true,
            'columns' => $columns,
            'formatter' => ['class' => 'yii\i18n\Formatter', 'nullDisplay' => '-'],
            'showPageSummary' => true,
            'striped' => true,
            'condensed' => true,
            'responsive' => true,
            'summary' => false,
            //'layout' => $layout,
            'rowOptions'=>function($model){
                if($model->date_service == Date('Y-m-d')){
                    return ['class' => 'info'];
                }
            },
            'replaceTags' => [
                '{custom}' => function($widget) {
                    if ($widget->panel === true) {
                        return '';
                    } else {
                        return '';
                    }
                }
            ],
            'pager' => [
                'options'=>['class'=>'pagination'], 
                'prevPageLabel' => 'Previous', 
                'nextPageLabel' => 'Next',
                'firstPageLabel'=>'First',
                'lastPageLabel'=>'Last',
                'nextPageCssClass'=>'next',
                'prevPageCssClass'=>'prev',
                'firstPageCssClass'=>'first',
                'lastPageCssClass'=>'last',
                'maxButtonCount'=>10,
        ],        
        ])
        ?>

        </div>

    </fieldset>

</div>



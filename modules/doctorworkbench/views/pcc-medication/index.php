<?php
use yii\helpers\Url;
use yii\helpers\Html;
use yii\bootstrap\Modal;
use kartik\grid\GridView;
use johnitvn\ajaxcrud\CrudAsset;
use johnitvn\ajaxcrud\BulkButtonWidget;

CrudAsset::register($this);
?>
<?=
$this->render('../default/panel_top', [
    'emr' => '',
    'lab' => '',
    'drug' => '',
    'diagnosis' => '',
    'medication' => 'active',
    'procedure' => '',
    'pre_order_lab' => '',
    'apointment' => '',
    'treatmment_plan' => ''
]);
?>
        <?php echo $this->render('./create', ['model' => $model]); ?>
<div class="pcc-diagnosis-index">
    <div id="ajaxCrudDatatable">
        <?=
        GridView::widget([
            'id' => 'crud-datatable',
            'dataProvider' => $dataProvider,
            'pjax' => true,
            'columns' => require(__DIR__ . '/_columns.php'),
            'formatter' => ['class' => 'yii\i18n\Formatter', 'nullDisplay' => '-'],
            'showPageSummary' => true,
            'striped' => true,
            'condensed' => true,
            'responsive' => true,
            'summary' => false,
        ])
        ?>
    </div>
</div>
<?= Html::button(Yii::t('app', 'Delete Select'), ['class' => 'btn btn-danger', 'id' => 'btn-delete', 'style' => 'margin-top:8px;']) ?>
<?php
Modal::begin([
    "id" => "ajaxCrudModal",
    "footer" => "",
])
?>
<?php Modal::end(); ?>
<?= $this->render('../default/panel_foot'); ?>
<?php
$js = <<< JS
// $('#icode').on('select2:select', function (e) {
//      $("#qty").focus();
// });
// $("#form-medication").submit(function(event) {
//     event.preventDefault();
//     var form = $("#form-medication");
//     var data = form.serialize();
//                 var url = form.attr('action');
//                 $.ajax({
//                     url: url,
//                     type: 'post',
//                     dataType: 'json',
//                     data: data
//                 })
//                 .done(function(response) {
//                     $.pjax.reload({container: "#crud-datatable-pjax"});
//                     console.log(response);
//                 })
//                 .fail(function() {
//                     console.log("error");
//                     //$.pjax.reload({container: "#crud-datatable-pjax"});
//         });
// });

 $("#btn-delete").click(function(){
    var keys = $("#crud-datatable").yiiGridView("getSelectedRows");
    //console.log(keys);
    var url = 'index.php?r=doctorworkbench/pcc-medication/bulk-delete'
    if(keys.length>0){
        $.ajax({
            url:url,
            method:'post',
            data:{pks:keys.join()},
            success: function(){
             $.pjax.reload({container: "#crud-datatable-pjax"});
            }
        });
        
    }
  });       
JS;
$this->registerJS($js);
?>
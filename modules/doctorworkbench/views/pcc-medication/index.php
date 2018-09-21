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
<?= Html::button('<i class="fa fa-trash"></i> Delete Select', ['class' => 'btn btn-danger', 'id' => 'btn-delete']) ?>

<?= Html::button('<i class="fa fa-print"></i> พิมพ์สติกเกอร์ยา', ['id' => 'modelButton', 'value' => \yii\helpers\Url::to(['print-med']), 'class' => 'btn btn-success']) ?>

<?php
            
Modal::begin([
        'header' => '<h4>Print</h4>',
        'id'     => 'modelprint',
        'size'   => 'modal-lg',
]);

echo "<div id='modelContent'></div>";

Modal::end();
?>



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
  
  
  $(function(){
    $('#modelButton').click(function(){
        $('#modelprint').modal('show')
            .find('#modelContent')
            .load($(this).attr('value'));
    });
});


JS;
$this->registerJS($js);
?>

<?php
use yii\helpers\Url;
use yii\helpers\Html;
use yii\bootstrap\Modal;
use kartik\grid\GridView;
$this->registerJS($this->render('../../dist/js/medication.js'));

?>

<?php
// กำหนด laypout ของ Gridvire เอง
$layout = <<< HTML
<div class="panel panel-info">
      <div class="panel-heading">
            <h3 class="panel-title">Mediaction List</h3>
      </div>
      <div class="panel-body">
<div class="row">
    <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
    {pager}
    </div>
    <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
        <div class="pull-right">
        {toggleData}
        {export}
        </div>
     </div>
    </div>
<div class="clearfix"></div>
{items}
</div>
</div>
HTML;
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
    'treatmment_plan' => '',
    'cc' => '',
    'pi' => '',
              'pe' => ''

]);
?>
<?php echo $this->render('./create', ['model' => $model]); ?>

<div style="margin-top:15px;margin-bottom:10px;">
<?= Html::button('<i class="fa fa-trash"></i> ลบรายการ', ['class' => 'btn btn-danger pull-eft', 'id' => 'btn-delete','style' => 'margin-right: 5px;']) ?>
<?= Html::button('<i class="fa fa-edit"></i> แก้ไขที่เลือก', ['class' => 'btn btn-warning pull-eft', 'id' => 'btn-update-select']) ?>
<?=Html::a('<i class="fa fa-print"></i> พิมพ์ฉลากยา','http://122.154.235.70/medico/report/',['class' => 'btn btn-info pull-right','target' => '_blank'])?>
<?php // Html::button('<i class="fa fa-print"></i> พิมพ์สติกเกอร์ยา', ['class' => 'pull-right','id' => 'modelButton', 'value' => \yii\helpers\Url::to(['print-med']), 'class' => 'btn btn-success']);// show modal ?> 
</div>

        <?=
        GridView::widget([
            'id' => 'crud-medication',
            'dataProvider' => $dataProvider,
            'pjax' => true,
            'columns' => require(__DIR__ . '/_columns.php'),
            'formatter' => ['class' => 'yii\i18n\Formatter', 'nullDisplay' => '-'],
            'showPageSummary' => true,
            'striped' => true,
            'condensed' => true,
            'responsive' => true,
            'summary' => false,
            'layout' => $layout,
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
<?php       
Modal::begin([
        'header' => '<h4>Print</h4>',
        'id'     => 'modelprint',
        'size'   => 'model-lg',
]);

echo "<div id='modelContent'></div>";
Modal::end();
?>

<?= $this->render('../default/panel_foot'); ?>
<?php
$js = <<< JS
// ======>  บันทึกข้อมูล 
var form = $("#form-medication");
$('body').on('beforeSubmit', '#form-medication', function () {
    // return false if form still have some validation errors
    if (form.find('.has-error').length) {
         return false;
    }
    $.ajax({
         url: form.attr('action'),
         type: 'post',
         data: form.serialize(),
         success: function (response) {
             $.pjax.reload({container: response.forceReload});
            // $('#icode').val(null);
         }
    });
    return false;
});

// ====> การลบข้อมูลที่เลือก
 $("#btn-delete").click(function(){
    var keys = $("#crud-medication").yiiGridView("getSelectedRows");
    //console.log(keys);
    var url = 'index.php?r=doctorworkbench/pcc-medication/bulk-delete'
    if(keys.length>0){
        $.ajax({
            url:url,
            method:'post',
            data:{pks:keys.join()},
            success: function(){
             $.pjax.reload({container: "#crud-medication-pjax"});
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

$('#crud-medication-pjax').on('pjax:complete', function() {
   // $('#icode').val(null).trigger('change');
   $(form)[0].reset();
    $('#icode').val(null).select2('open');
    totalPrice($('#cid').val());

})

JS;
$this->registerJS($js);
?>
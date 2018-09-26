<?php
use yii\helpers\Url;
use yii\helpers\Html;
use yii\bootstrap\Modal;
use kartik\grid\GridView;
use johnitvn\ajaxcrud\CrudAsset; 
use johnitvn\ajaxcrud\BulkButtonWidget;
use yii\web\View;
use kartik\widgets\Select2;
use yii\web\JsExpression;
use yii\widgets\Pjax;
CrudAsset::register($this);
// $this->registerJS($this->render('../../dist/js/script.js'));
?>
<style>
.pagination {
    display: inline-block;
    padding-left: 0;
    margin: 0px;
    border-radius: 4px;
}
</style>
<?php
echo $this->render('../default/panel_top',[
'emr' => '',
'lab' => '',
'drug' => '',
'diagnosis' => 'active',
'medication' => '',
'procedure' => '',
'pre_order_lab' =>'',
'apointment' => '',
'treatmment_plan' => '',
'cc' => '',
'pi' => '',
              'pe' => ''
]);?>

<?php
// กำหนด laypout ของ Gridvire เอง
$layout = <<< HTML
<div class="panel panel-info">
      <div class="panel-heading">
            <h3 class="panel-title">Diagnosis List</h3>
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


<?php  echo $this->render('./create',['model' => $model]);?>
<?= Html::button('<i class="fa fa-trash"></i> ลบรายการ', ['class' => 'btn btn-danger','id'=>'btn-delete','style' => 'margin-bottom:5px;']) ?>
<div class="pcc-diagnosis-index">
    <div id="ajaxCrudDatatable">
        <?=GridView::widget([
            'id'=>'crud-diagnosis',
            'dataProvider' => $dataProvider,
            'formatter' => ['class' => 'yii\i18n\Formatter','nullDisplay' => '-'],
            'pjax'=>true,
            'columns' => require(__DIR__.'/_columns.php'),        
            'striped' => true,
            'condensed' => true,
            'responsive' => true,  
            'summary'=>false,
            'showFooter' => false,
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
        ])?>
    </div>
</div>


<?php Modal::begin([
    "id"=>"ajaxCrudModal",
    "footer"=>"",
])?>
<?php Modal::end(); ?>
<?php echo $this->render('../default/panel_foot');?>

<?php
$js = <<< JS
// ======>  บันทึกข้อมูล 
$('body').on('beforeSubmit', '#form-diagnosis', function () {
    var form = $("#form-diagnosis");
    // return false if form still have some validation errors
    if (form.find('.has-error').length) {
         return false;
    }
    $.ajax({
         url: form.attr('action'),
         type: 'post',
         data: form.serialize(),
         success: function (response) {
             $.pjax.reload({container: "#crud-diagnosis-pjax"});
            //  $('#icd_code').val(null).trigger('change');
            $("#form-diagnosis")[0].reset();
            totalPrice($('#hn').val(),$('#vn').val());
         }
    });
    return false;
});

// ====> การลบข้อมูลที่เลือก
 $("#btn-delete").click(function(){
    var keys = $("#crud-datatable-pjax").yiiGridView("getSelectedRows");
    //console.log(keys);
    var url = 'index.php?r=doctorworkbench/pcc-diagnosis/bulk-delete'
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


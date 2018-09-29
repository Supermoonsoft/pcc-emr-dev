<?php
use yii\helpers\Url;
use yii\helpers\Html;
use yii\bootstrap\Modal;
use kartik\grid\GridView;
use yii\web\View;
use kartik\widgets\Select2;
use yii\web\JsExpression;
?>

<?php
// กำหนด laypout ของ Gridvire เอง
$layout = <<< HTML
<div class="panel panel-info">
      <div class="panel-heading">
            <h3 class="panel-title">Procedure List</h3>
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
<?=$this->render('../default/panel_top',[
'emr' => '',
'lab' => '',
'drug' => '',
'diagnosis' => '',
'medication' => '',
'procedure' => 'active',
'pre_order_lab' =>'',
'apointment' => '',
'treatmment_plan' => '',
'cc' => '',
'pi' => '',
              'pe' => ''

]);?>

<?php  echo $this->render('./create',['model' => $model]);?>
<?= Html::button('<i class="fa fa-trash"></i> ลบรายการ', ['class' => 'btn btn-danger','id'=>'btn-delete','style' => 'margin-bottom:5px;']) ?>

    <?=
        GridView::widget([
            'id' => 'crud-procedure',
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

<?=$this->render('../default/panel_foot');?>
<?php
$js = <<< JS

// ======>  บันทึกข้อมูล 
$('body').on('beforeSubmit', '#form-procedure', function () {
    var form = $("#form-procedure");
    // return false if form still have some validation errors
    if (form.find('.has-error').length) {
         return false;
    }
    $.ajax({
         url: form.attr('action'),
         type: 'post',
         data: form.serialize(),
         beforeSend: function() {
 
    },
    success: function (response) {
            $.pjax.reload({container: response.forceReload});
            $(form)[0].reset();
            console.log(response);
         },
    });
    return false;
});


 $("#btn-delete").click(function(){
    var keys = $("#crud-procedure").yiiGridView("getSelectedRows");
    //console.log(keys);
    var url = 'index.php?r=doctorworkbench/pcc-procedure/bulk-delete'
    if(keys.length>0){
        $.ajax({
            url:url,
            method:'post',
            data:{pks:keys.join()},
            success: function(){
            $.pjax.reload({container:"#crud-procedure-pjax"});
            }
        });
    }
  });


$('#crud-procedure-pjax').on('pjax:complete', function() {
    $('#procedure_code').select2('open');
})

    $('#procedure_code').select2('change',function(){

    });

JS;
$this->registerJS($js);
?>


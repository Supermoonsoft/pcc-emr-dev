<?php
use yii\helpers\Url;
use yii\helpers\Html;
use yii\bootstrap\Modal;
use kartik\grid\GridView;
use yii\web\View;
use kartik\widgets\Select2;
use yii\web\JsExpression;
use yii\widgets\Pjax;
use app\components\PatientHelper;
$this->registerJs($this->render('../../dist/js/script.js'));
$this->registerJs($this->render('../../dist/js/rediag.js'));
$this->registerCss($this->render('../../dist/css/style.css'));

//$this->title = 'Diagnosis';
//$this->params['breadcrumbs'][] = ['label' => 'Order', 'url' => ['/doctorworkbench/pcc-diagnosis']];
//$this->params['breadcrumbs'][] = $this->title;
$action_index = Url::to(['index']);
?>
<span id="index" action="<?=$action_index;?>"></span>
<style>
.pagination {
    display: inline-block;
    padding-left: 0;
    margin: 0px;
    border-radius: 4px;
}
/* .table-striped > tbody > tr:nth-child(2n+1) > td, .table-striped > tbody > tr:nth-child(2n+1) > th {
    background-color: #fcf7ff;
} */
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
        'pe' => '',
        'education' => ''
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
<br>
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
            'headerRowOptions' => ['style' => 'background-color: #eee;'],
            //'layout' => $layout,
            'rowOptions'=>function($model,$id){
                if($model->id == Yii::$app->request->get('id')){
                    return ['class' => 'success'];
                }
            },
            'options' => [
                'class' => 'background-color: red',
             ],
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
 <?php $alert = 'swal("ส่งทีละหลายรายการ...")' ;?>
        
        <div class="row" style="margin-bottom: 2px;">
            <div class="col-xs-3 col-sm-3 col-md-3 col-lg-3">
            <button class="btn btn-info" id="re-diag" onClick=<?php //new JsExpression($alert)?>><i class="fa fa-check"></i> xxxxxx </button>
                
            </div>    
            <div class="col-xs-9 col-sm-9 col-md-9 col-lg-9">
            <div class="progress" style=" height: 34px;margin-bottom: -8px;margin-left: -71px;">
  <div id='p' class="progress-bar progress-bar-success progress-bar-striped active" role="progressbar"
  aria-valuenow="40" aria-valuemin="0" aria-valuemax="100" style="padding-top: 8px; font-size: 20px;">
  100
  </div>
</div>
            </div>
            
        </div>

 <?= GridView::widget([
        'dataProvider' => $drugHis,
        //'filterModel' => $searchModel,
        //'showPageSummary'=>true,
        'summary'=>false,
        'pjax'=>true,
        'pjaxSettings'=>[
            'neverTimeout'=>true,
        ],
        'options' => [
            'id' => 'gridview-id'
        ],
        'striped'=>true,
        'hover'=>true, 
        'toolbar' =>  ['{toggleData}',],
        'formatter' => ['class' => 'yii\i18n\Formatter', 'nullDisplay' => '-'], 
        'rowOptions' => function ($model, $key, $index, $grid) { //สามารถกำหนด data-key ใหม่ (ปกติจะใช้ PK)
            return ['data' => ['key' => [
                'pcc_vn' => $model->pcc_vn,
                'diag_text' => $model->diag_text,
                'icd_code' => $model->icd_code,
                'diag_type' => $model->diag_type,
                'hn' => $model->hn,
                'vn' => $model->vn,
            ]]];
        }, 
        'columns' => [
            [
                'class' => 'yii\grid\CheckboxColumn',
                'header' => false,
                'checkboxOptions' =>

                function($model) {
        
                    return ['value' => $model->id, 'class' => $model->pcc_vn, 'id' => 'checkbox'];
        
                }
            ],
            [
                'attribute'=>'date_visit', 
                'format'=>'raw',
                'value'=>function ($model, $key, $index, $widget) { 
                    return Html::checkbox($model->pcc_vn).' '.$model->thaidate($model->date_service);
                },
                'filter'=>false,
                'group'=>true,  // enable grouping,
                'groupedRow'=>true,                    // move grouped column to a single grouped row
                'groupOddCssClass'=>'kv-grouped-row',  // configure odd group cell css class
                'groupEvenCssClass'=>'kv-grouped-row', // configure even group cell css class
            ],
            [
                'class'=>'\kartik\grid\DataColumn',
                'attribute'=>'diag_text',
                'header' => 'DiagText',
                'width' => '185px',
                'value' => function($model){
                    return $model->diag_text;
                }

            ],
            [
                'class'=>'\kartik\grid\DataColumn',
                'width' => '40px',
                'attribute'=>'icd_code',
                'header' => 'ICD10',
            ],
            [
                'class'=>'\kartik\grid\DataColumn',
                'attribute'=>'icd_name',
                'header' => 'ชื่อโรค',
        
            ],
            [
                // 'class' => '\kartik\grid\DataColumn',
                'attribute' => 'diag_type',
                'hAlign' => 'left',
                'vAlign' => 'middle',
                'header' => 'ประเภท',
                'value' => function($model){
                    if($model->diag_type != ''){
                        return $model->diagtype1->diagtype.'-'.$model->diagtype1->name1;
                    } else {
                        return '-';
                    }
                    
                }
            ],
            // [
            //     'class' => 'kartik\grid\ActionColumn',
            //     'template' => '{delete}',
            //     'buttons' => [
            //         'delete' => function ($url) {
            //             return Html::a('<i class="far fa-trash-alt"></i> ', '#', [
            //                 'title' => Yii::t('yii', 'Delete'),
            //                 'class' => '',
            //                 'aria-label' => Yii::t('yii', 'Delete'),
            //                 'onclick' => "
            //                     // if (confirm('ok?')) {
            //                         $.ajax('$url', {
            //                             type: 'POST'
            //                         }).done(function(data) {
            //                             $.pjax.reload({container: '#crud-diagnosis-pjax'});
            //                         });
            //                     // }
            //                     return false;
            //                 ",
            //             ]);
            //         },
            //     ],
            // ],
        ],
            
    ]); ?>



<?php echo $this->render('../default/panel_foot');?>

<?php
$js = <<< JS
// ====> การลบข้อมูลที่เลือก
 $("#btn-delete").click(function(){
     // ลบแบบ checkbox
    var keys = $("#crud-diagnosis").yiiGridView("getSelectedRows");
    //console.log(keys);
    var url = 'index.php?r=doctorworkbench/pcc-diagnosis/bulk-delete'
    if(keys.length>0){
        $.ajax({
            url:url,
            method:'post',
            data:{pks:keys.join()},
            success: function(){
             $.pjax.reload({container: "#crud-diagnosis-pjax"});
             $('.clear').val(null).trigger('change');
                $('.fires').val(null).select2('open');
                totalPrice($('#cid').val());
               $('#form-diagnosis')[0].reset();
               $('#id').attr('disabled',true).val('');
               $('#icon').removeClass('fas fa-edit');
               $('#icon').addClass('fas fa-plus');
               $('#btn-save').addClass('btn-success');
                $('#btn-save').removeClass('btn-warning');
                $('#form-diagnosis').attr('action', $('#create').attr('action'));
            }
        });
    }else{
        swal('เลือข้อมูล');
    }


  });

      $('.kv-row-checkbox').click(function(e){ // ใช้สำหรับ checkbox
        var keys = $("#crud-diagnosis").yiiGridView("getSelectedRows");
        // var url = Url::to(['index']);
        var id = $(this).attr('value');
        if(keys.length > 1){
            swal('เลือกเพียง 1 รายการ');
            return false;
        }else{
            if (e.target.checked) {
               
            //  alert();
            window.location.href = $('#index').attr('action')+'&id='+id;
            }else{
            window.location.href = $('#index').attr('action');
               
            }
        }

    });

 $('#crud-diagnosis').on('grid.radiochecked', function(ev, key, val) { // ใช้สำหรับ Radiobox
     //console.log("Key = " + key + ", Val = " + val);
               window.location.href = $('#index').attr('action')+'&id='+val;
 });
 $('#crud-diagnosis').on('grid.radiocleared', function(ev, key, val) {
    //console.log("Key = " + key + ", Val = " + val);
    window.location.href = $('#index').attr('action');
});
 
JS;
$this->registerJS($js);
?>


<?php

use yii\helpers\Html;
use kartik\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel app\modules\lab\models\PreorderlabSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Preorderlabs';
?>
 <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

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
    <div class="pull-left">
<!-- <button class="btn btn-danger"id="btn-delete" style="margin-bottom:5px;"><i class="fa fa-trash"></i> ลบรายการ</button> -->
        </div>
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
<?= Html::button('<i class="fa fa-trash"></i> ลบรายการ', ['class' => 'btn btn-danger','id'=>'btn-delete','style' => 'margin-bottom:5px;']) ?>

<div class="preorderlab-index">
 <?=
        GridView::widget([
            'id' => 'pre-order-lab',
            'dataProvider' => $dataProvider,
            'pjax' => true,
            'columns' => [
                [
                    'class' => 'kartik\grid\CheckboxColumn',
                    'width' => '20px',
                ],
                [
                    'class' => 'kartik\grid\SerialColumn',
                    'width' => '30px',
                ],
                'lab_name',
                'lab_request_date',
                'lab_result_date',
                'lab_result',
                'standard_result',
            ],
            'formatter' => ['class' => 'yii\i18n\Formatter', 'nullDisplay' => '-'],
            'showPageSummary' => true,
            'striped' => true,
            'condensed' => true,
            'responsive' => true,
            'summary' => false,
            //'layout' => $layout,
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
<?php
$js = <<< JS
 $("#btn-delete").click(function(){
    var keys = $("#pre-order-lab").yiiGridView("getSelectedRows");
    //console.log(keys);
    var url = 'index.php?r=lab/preorderlab/bulk-delete'
    if(keys.length>0){
        $.ajax({
            url:url,
            method:'post',
            data:{pks:keys.join()},
            success: function(response){
            $.pjax.reload({container:response.forceReload});
            }
        });
    }
  });

JS;
$this->registerJS($js);
?>


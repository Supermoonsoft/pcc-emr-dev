<?php
use yii\helpers\Url;
use yii\helpers\Html;
use yii\bootstrap\Modal;
use kartik\grid\GridView;
use johnitvn\ajaxcrud\CrudAsset; 
use johnitvn\ajaxcrud\BulkButtonWidget;

CrudAsset::register($this);

?>
<?=$this->render('../default/panel_top');?>
<?php  echo $this->render('./create',['model' => $model]);?>
<div class="pcc-diagnosis-index">
    <div id="ajaxCrudDatatable">
        <?=GridView::widget([
            'id'=>'crud-datatable',
            'dataProvider' => $dataProvider,
            // 'filterModel' => $searchModel,
            'pjax'=>true,
            'columns' => require(__DIR__.'/_columns.php'),        
            'striped' => true,
            'condensed' => true,
            'responsive' => true,          
        ])?>
    </div>
</div>
<?php Modal::begin([
    "id"=>"ajaxCrudModal",
    "footer"=>"",// always need it for jquery plugin
])?>
<?php Modal::end(); ?>

<?php
$js = <<< JS
$('#icd_code').change(function(){
// $('#form-diagnosis').submit();
var form = $("#form-diagnosis");
var data = form.serialize();
            var url = form.attr('action');
            $.ajax({
                url: url,
                type: 'post',
                dataType: 'json',
                data: data
            })
            .done(function(response) {
               
                $.pjax.reload({container: "#crud-datatable-pjax"});
                console.log(response);

            })
            .fail(function() {
                console.log("error");
                $.pjax.reload({container: "#crud-datatable-pjax"});

            });

});
       $("#form-diagnosis").submit(function(event) {
            event.preventDefault(); // stopping submitting
           
        });


JS;
$this->registerJS($js);
?>
<?=$this->render('../default/panel_foot');?>

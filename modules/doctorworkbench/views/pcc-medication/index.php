<?php
use yii\helpers\Url;
use yii\helpers\Html;
use yii\bootstrap\Modal;
use kartik\grid\GridView;
use johnitvn\ajaxcrud\CrudAsset; 
use johnitvn\ajaxcrud\BulkButtonWidget;

CrudAsset::register($this);
// $this->registerJS($this->render('../../dist/js/script.js'));
?>

<?=$this->render('../default/panel_top',[
'diagnosis' => '',
'medication' => 'active',
'procedure' => '',
'ppointment' => '',
]);?>
<?php  echo $this->render('./create',['model' => $model]);?>
<div class="pcc-diagnosis-index">
    <div id="ajaxCrudDatatable">
        <?=GridView::widget([
            'id'=>'crud-datatable',
            'dataProvider' => $dataProvider,
            'pjax'=>true,
            'columns' => require(__DIR__.'/_columns.php'), 
	'summary'=>false,       
            'striped' => true,
            'condensed' => true,
            'responsive' => true,          
        ])?>
    </div>
</div>
<?php Modal::begin([
    "id"=>"ajaxCrudModal",
    "footer"=>"",
])?>
<?php Modal::end(); ?>
<?=$this->render('../default/panel_foot');?>
<?php
$js = <<< JS
// $('#icode').on('select2:select', function (e) {
//      $("#qty").focus();
// });
$("#form").submit(function(event) {
    event.preventDefault();
    var form = $("#form");
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
function dataForm(){
   

}
JS;
$this->registerJS($js);
?>
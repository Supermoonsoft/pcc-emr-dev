<?php
use app\components\MessageHelper;
use app\assets\DataTableAsset;
use yii\widgets\ActiveForm;
use kartik\helpers\Html;
use yii\helpers\ArrayHelper;
use yii\helpers\Url;
use yii\bootstrap\Modal;
use kartik\grid\GridView;
use app\modules\queuemanage\models\CDoctorRoom;
use app\modules\queuemanage\models\PccDoctorRoomQueue;
use app\components\DbHelper;



?>
<div class="panel panel-info">
      <div class="panel-heading">
      <i class="fa fa-clock-o" aria-hidden="true"></i> ผู้ป่วยรอส่งเข้าพบแพทย์ 
      </div>
      <div class="panel-body">
            
            <div class="row">
            <div class="col-xs-7 col-sm-7 col-md-7 col-lg-7">
            <div style="margin-bottom: 3px">
            <?php
            $array = ArrayHelper::map(CDoctorRoom::find()->orderBy('id ASC')->all(),'id','room_title');
            echo Html::dropDownList('room', '0',$array, ['class' => 'form-control form-control-inline', 'id' => 'room','prompt'=>'เลือกห้องตรวจ'])
            ?>

            <button id='btn_add_q' type="submit" class="btn btn-pink"><i class="fa fa-check"></i> ส่งพบแพทย์</button>
             <?=Html::a('<i class="fa fa-user-md" aria-hidden="true"></i> ตั้งค่า',['/queuemanage/room'], ['class' => 'btn btn-light-green pull-right'])?>
        </div>

 <?=GridView::widget([
            'id'=>'crud-q',
            'dataProvider' => $dataProvider,
            'rowOptions' => function ($model, $key, $index, $grid) { //สามารถกำหนด data-key ใหม่ (ปกติจะใช้ PK)
                return ['data' => ['key' => $model['cid'].'-'.$model['pcc_vn']]];
            },        
            'formatter' => ['class' => 'yii\i18n\Formatter','nullDisplay' => '-'],
            'pjax'=>true,
            'columns' => require(__DIR__.'/_columns.php'),        
            'striped' => true,
            'condensed' => true,
            'responsive' => true,  
            'summary'=>false,
            'showFooter' => false,
           // 'layout' => $layout,
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

                <div class="col-xs-5 col-sm-5 col-md-5 col-lg-5">
                <div class="panel panel-info">
                    <div class="panel-heading">
                        <div class="panel-title">
                            ผลตรวจทางห้องปฏิบัติการ
                        </div>                        
                    </div>
                    <div class="panel-body">
                        <!-- <div id="lab-view"></div> -->

                        <table class="table">
                        <thead>
                        <tr>
                        <th>ลำดับ</th>
                        <th>รายการ</th>
                        <th>ผล</th>
                        <th>มาตรฐาน</th>
                        </tr>
                        </thead>
                        <tbody id="lab-view">
    
                    </tbody>
                </table>
                        
                    </div>
                </div>
                
               
                
            </div>
            
      </div>
</div>
<?php
$js = <<< JS

$('tr').hover(function () {
    $(this).css("background-color", "skyblue");

}, function () {
    $(this).css("background-color", "");
});

$('tr').click(function () {
    $(this).css("background-color", "orange");
    $('#lab-view').html('Loading...');
    let cid = $(this).closest("tr").data("key");
    let pcc_vn = $(this).data('pccvn');
    let uri = 'index.php?r=queuemanage/ajax/lab-view&cid=' + cid;
    $.get(uri, function (data) {
     //  $('#lab-view').html(JSON.stringify(data))
      // console.log(data);
      $('#lab-view').html(data);
    });

    
});

    $('.kv-row-checkbox').click(function(){
      $.ajax({
       type: "post",
       url: "index.php?r=queuemanage/ajax/q-order",
       data:{key:$(this).closest('tr').data('key')},
       dataType: "json",
       success: function (response) {
      $('#'+response.pcc_vn+'').html(response.order_number);
      $('#result'+response.pcc_vn+'').hide();
      console.log(response.pcc_vn);
       }
   });

   $( ".kv-row-checkbox" ).unbind( "click", function(){
       alert();
   });

    });

JS;
$this->registerJS($js);
?>
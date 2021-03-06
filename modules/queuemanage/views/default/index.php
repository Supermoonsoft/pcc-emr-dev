<?php

use app\components\MessageHelper;
use app\assets\DataTableAsset;
use yii\widgets\ActiveForm;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\helpers\ArrayHelper;
use yii\widgets\Pjax;
use yii\widgets\LinkPager;
use app\modules\queuemanage\models\CDoctorRoom;

DataTableAsset::register($this);
?>


<?php
if($param == 0){
$btn_text = 'แสดงทั้งหมด';
$send = 1;
}else{
$btn_text = 'ยังไม่ส่งตรวจ';
$send = 0;
}
?>
<div class="panel panel-info">
    <div class="panel-heading">
        <div class="panel-title">
            <i class="fa fa-clock-o" aria-hidden="true"></i> ผู้ป่วยรอส่งเข้าพบแพทย์ 
            <!-- <object align='right'><a class="btn btn-lbrown">แสดงทั้งหมด</a></object> -->
            <object align='right' style="margin-top: -5px;">
            <?= Html::a($btn_text, 
                // ['/queuemanage/pcc-visit'], [
                ['/queuemanage/default/view-all'], [
                'class' => 'btn btn-lbrown',
                'data-method' => 'POST',
                'data-params' => [
                    'param' => $send,
                ],
            ]) ?>
            </object>
       
       
        </div>
    </div>
    <div class="panel-body">
<?php if($param == 0):?>

        <?php
        ActiveForm::begin([
            'id' => 'form-add-q',
            'action' => ['default/save'],
            'method' => 'post'
        ]);
        ?>
 <div class="row">
            <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6" style="padding-right: 0px">
            <div style="margin-bottom: 3px">
            <?php
            $array = ArrayHelper::map(CDoctorRoom::find()->orderBy('id ASC')->all(),'id','room_title');
            echo Html::dropDownList('room', '0',$array, ['class' => 'form-control form-control-inline', 'id' => 'room','prompt'=>'เลือกห้องตรวจ','style' => 'width:241px;'])
            ?>
            <button id='btn-save' type="submit" class="btn btn-pink" style='width:103px;'><i class="fa fa-check"></i> ส่งพบแพทย์</button>
            <?php // ActiveForm::end(); ?>     
            <input type='text' id='txt_name' placeholder='ค้นหา' class="form-control form-control-inline pull-right" style="width: 165px;">
             
        </div>
            </div>
            <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
             <?=Html::a('<i class="fa fa-user-md" aria-hidden="true"></i> ตั้งค่าห้องตวจแพทย์',['/queuemanage/room'], ['class' => 'btn btn-light-green pull-right'])?>                
            </div>
        </div>
        
        <div class="row">
        <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6" style="padding-right: 0px">
                    <table class="table  table-bordered">
                        <thead style="background-color: #eee;">
                            <tr>
                                <th></th>                                
                                <th>บัตรประชาชน</th>
                                <th >ลำดับส่ง</th>
                                <th >เวลามาถึง</th>                                
                                <th >วันที่ - เวลานัดหมาย</th>                                
                                <th>ชื่อ นามสกุลผู้ป่วย</th>

                            </tr>
                        </thead>
                        <tbody>

                            <?php foreach ($rows as $key => $value): ?>
                                <tr data-cid="<?= $value['cid'] ?>" class="tr-vn">
                                    <td>
                                        <input class="chk_pt" type="checkbox" name="pt[]" value="<?= $value['pcc_vn'] ?>" />
                                    </td>
                                    <td><?= $value['cid'] ?></td>
                                    <td data-num=2 >
                                    <input type="hidden" name="num[]" value="" id="input<?=$value['pcc_vn']?>"/>
                                    <input type="hidden" name="sendtime[]" value="" id="time<?=$value['pcc_vn']?>"/>
                                    <input type="hidden" name="cid[]" value="<?= $value['cid'] ?>"/>
                                    
                                    <div  id="<?=$value['pcc_vn']?>" class="send_no"></div>
                                    <div id="time<?=$value['pcc_vn']?>"></div>
                                    </td>
                                    <td>
                                        <?php
                                        $thaidate = new  CDoctorRoom();
                                        echo $thaidate->thaidate($value['visit_date_begin']) . ' ' . $value['visit_time_begin'] ?>
                                    
                                    </td>                                    
                                    <td></td>
                                    <td><?= $value['fullname'] ?></td>

                                </tr>                                
                            <?php endforeach; ?>
                        </tbody>

                    </table>
                    <?php
echo LinkPager::widget([
    'pagination' => $pages,
]);
?>
            </div>
            <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
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
                        <th>ค่ามาตราฐานอ้างอิง</th>
                        <th>หมายเหตุ</th>
                        </tr>
                        </thead>
                        <tbody id="lab-view">
    
                    </tbody>
                </table>
                        
                    </div>

                </div>


            </div>
        </div>
        <?php ActiveForm::end(); ?>      
        <?php else:?>
<?=$this->render('./view_all',['raw' => $raw,]);?>
        <?php endif;?>
    </div>
</div>

<?php
$this->registerJs($this->render('script.js'));
?>


<?php
$js = <<< JS
$(document).ready(function(){

$('#txt_name').keyup(function(){ // เมื่อมีการค้นหา

  var search = $(this).val(); // นำค่า vulue ใส่ในตัวแปร search

  $('table tbody tr').hide();

  var len = $('table tbody tr:not(.notfound) td:contains("'+search+'")').length;

  if(len > 0){

    $('table tbody tr:not(.notfound) td:contains("'+search+'")').each(function(){
       $(this).closest('tr').show();
    });
  }else{
    $('.notfound').show();
  }

});
});
$.expr[":"].contains = $.expr.createPseudo(function(arg) {
 return function( elem ) {
   return $(elem).text().toUpperCase().indexOf(arg.toUpperCase()) >= 0;
 };
});

JS;
$this->registerJS($js);

?>


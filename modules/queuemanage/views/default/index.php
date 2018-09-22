<?php

use app\components\MessageHelper;
use app\assets\DataTableAsset;
use yii\widgets\ActiveForm;

DataTableAsset::register($this);
?>
<div class="panel panel-info">


    <div class="panel-heading">
        <div class="panel-title">
            <i class="fa fa-clock-o" aria-hidden="true"></i> ผู้ป่วยรอส่งเข้าพบแพทย์ 
            <object align='right'><a class="btn btn-success">ทั้งหมด</a></object>
        </div>
    </div>
    <div class="panel-body">
        <?php
        ActiveForm::begin([
        ]);
        ?>
        <?= MessageHelper::Note(" แสดง Lab detailview ขวามือ เมื่อคลิก/hover ที่ คนไข้ ") ?>
        <?= MessageHelper::Note(" เลือกห้องตรวจก่อนส่งเข้าตรวจทีละหลายคน ") ?>
        <?= MessageHelper::Note(" คลิกแล้วเรียกลำดับ ตัวเลขลำดับส่งเข้าตรวจเปลี่ยนตามคลิก ก่อน/หลัง ") ?>
        <?= MessageHelper::Note("ลง SCREEN /VST / CC /PE /PI ก่อนเข้าพบแพทย์ที่นี่??? (กรณีไม่ลงที่ JHCIS)") ?>
        <div style="margin-bottom: 3px">
            <button id='btn_add_q' type="submit" class="btn btn-info"><i class="fa fa-check"></i> ส่งพบแพทย์</button>
            <a class="btn btn-danger pull-right" href="#"><i class="fa fa-user-md" aria-hidden="true"></i> ตั้งค่า</a>        
        </div>

        <div class="row">
            <div class="col-lg-8">
                <div id="grid-view-data-table" class="grid-view">
                    <table class="table  table-bordered">
                        <thead>
                            <tr>
                                <th></th>                                
                                <th>Hn</th>
                                <th>ลำดับส่ง</th>
                                <th>เวลามา</th>                                
                                <th>ชื่อ นามสกุล</th>
                                <th>รายการตรวจสอบ</th>
                            </tr>
                        </thead>
                        <tbody>

                            <?php foreach ($raw as $key => $value): ?>
                                <tr data-key="<?= $value['pcc_vn'] ?>">
                                    <td>
                                        <input class="chk_pt" type="checkbox" name="pt[]" value="<?= $value['pcc_vn'] ?>" />
                                    </td>

                                    <td><?= $value['hn'] ?></td>
                                    <td><div id="<?= 'v' . $value['pcc_vn'] ?>"></div></td>
                                    <td><?= $value['visit_date_begin'] . ' ' . $value['visit_time_begin'] ?></td>                                    
                                    <td><?= $value['fullname'] ?></td>
                                    <td><span style='color:green'>Lab</span></td>
                                </tr>                                
                            <?php endforeach; ?>



                        </tbody>

                    </table>
                </div>
            </div>
            <div class="col-lg-4">
                LAB Detail view
            </div>
        </div>
        <?php ActiveForm::end(); ?>      

    </div>
</div>
<pre>
<?php
print_r($data);
$this->registerJs($this->render('script.js'));
?>
</pre>



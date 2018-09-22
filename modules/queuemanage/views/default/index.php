<?php

use app\components\MessageHelper;
?>
<div class="panel panel-info">


    <div class="panel-heading">
        <div class="panel-title"><i class="fa fa-clock-o" aria-hidden="true"></i> ผู้ป่วยรอส่งเข้าพบแพทย์</div>
    </div>
    <div class="panel-body">
        <?= MessageHelper::Note(" แสดง Lab detailview ขวามือ เมื่อคลิก/hover ที่ คนไข้ ") ?>
        <?= MessageHelper::Note(" เลือกห้องตรวจก่อนส่งเข้าตรวจทีละหลายคน ") ?>
        <?= MessageHelper::Note(" คลิกแล้วเรียกลำดับ ตัวเลขลำดับส่งเข้าตรวจเปลี่ยนตามคลิก ก่อน/หลัง ") ?>
<?= MessageHelper::Note("ลง SCREEN /VST / CC /PE /PI ก่อนเข้าพบแพทย์ที่นี่??? (กรณีไม่ลงที่ JHCIS)") ?>
        <div style="margin-bottom: 3px">
            <button class="btn btn-info" onClick=swal("ยืนยันส่งคนที่เลือก...")><i class="fa fa-check"></i> ส่งพบแพทย์</button>
            <a class="btn btn-danger pull-right" href="#"><i class="fa fa-user-md" aria-hidden="true"></i> ตั้งค่า</a>        
        </div>

        <div class="row">
            <div class="col-lg-8">
                <div id="grid-view-data-table" class="grid-view">
                    <table class="table table-striped table-bordered">
                        <thead>
                            <tr>
                                <th></th>
                                <th>#</th>
                                <th>Hn</th>
                                <th>เวลามา</th>
                                <th>เวลานัด</th>
                                <th>ชื่อ นามสกุล</th>
                                <th>รายการตรวจสอบ</th>
                            </tr>
                        </thead>
                        <tbody>

                            <tr data-key="0">
                                <td>
                                    <input type="checkbox" name="selection[]" value="0" />
                                </td>
                                <td>1</td>
                                <td>000000009</td>
                                <td>20/09/2561 เวลา 14:09:14</td>
                                <td>-</td>
                                <td>น.ส.สวยงาม สอง มากเลย</td>
                                <td><span style='color:green'>Lab</span></td>
                            </tr>
                            <tr data-key="1">
                                <td><input type="checkbox" name="selection[]" value="1"/></td>
                                <td>2</td><td>000000012</td>
                                <td>20/09/2561 เวลา 14:09:59</td>
                                <td>-</td><td>นายพ็อกบ้า  ยิ่งมั่ว</td>
                                <td><span style='color:green'>Lab</span></td>
                            </tr>
                            <tr data-key="2"><td><input type="checkbox" name="selection[]" value="2" /></td>
                                <td>3</td><td>000000004</td>
                                <td>20/09/2561 เวลา 14:11:02</td>
                                <td>-</td><td>นายสมชาย  มีมาก</td>
                                <td><span style='color:green'>Lab</span></td>
                            </tr>


                        </tbody>

                    </table>
                </div>
            </div>
            <div class="col-lg-4">
                LAB Detail view
            </div>
        </div>

    </div>
</div>



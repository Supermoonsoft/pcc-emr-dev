<div class="queuemanage-default-index">
</div><div class="panel panel-info">
    <div class="panel-heading">
        <div class="panel-title"><i class="fa fa-clock-o" aria-hidden="true"></i> ผู้ป่วยรอส่งเข้าพบแพทย์</div>
    </div>
    <div class="panel-body">
        <div style="margin-bottom: 3px">
                        <button class="btn btn-info" onClick=swal("ส่งทีละหลายคน...")><i class="fa fa-check"></i> ส่งพบแพทย์เฉพาะที่เลือก</button>
            <a class="btn btn-danger pull-right" href="#"><i class="fa fa-user-md" aria-hidden="true"></i> ตั้งค่า</a>        </div>
        <div id="grid-view-data-table" class="grid-view">
        <table class="table table-striped table-bordered">
            <thead>
                <tr>
                    <th><input type="checkbox" class="select-on-check-all" name="selection_all" value="1"></th>
                    <th>#</th><th>Hn</th>
                    <th>เวลามา</th>
                    <th>เวลานัด</th>
                    <th>ชื่อ นามสกุล</th>
                    <th>รายการตรวจสอบ</th>
                </tr>
            </thead>
            <tbody>
                <tr data-key="0">
                    <td><input type="checkbox" name="selection[]" value="0"></td>
                    <td>1</td><td>000000009</td><td>2018-09-20 เวลา 14:09:14</td>
                    <td>-</td><td>น.ส.สวยงาม สอง มากเลย</td>
                    <td><span style='color:green'>Lab<span></td>
                </tr>
                <tr data-key="1">
                    <td><input type="checkbox" name="selection[]" value="1"></td>
                    <td>2</td><td>000000012</td>
                    <td>2018-09-20 เวลา 14:09:59</td>
                    <td>-</td><td>นายพ็อกบ้า  ยิ่งมั่ว</td>
                    <td><span style='color:green'>Lab<span></td>
                </tr>
                    <tr data-key="2"><td><input type="checkbox" name="selection[]" value="2"></td>
                    <td>3</td><td>000000004</td>
                    <td>2018-09-20 เวลา 14:11:02</td>
                    <td>-</td><td>นายสมชาย  มีมาก</td>
                    <td><span style='color:green'>Lab<span></td>
                </tr>
            </tbody>
        </table>
    </div>
</div>



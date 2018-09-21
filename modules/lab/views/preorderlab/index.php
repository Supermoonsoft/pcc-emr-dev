<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
?>
<div class="preorderlab-index">
    <?php Pjax::begin(); ?>
    <div class="panel panel-info">
    <div class="panel-heading">
        <div class="panel-title"><i class="fa fa-flask" aria-hidden="true"></i> รายการแลป</div>
    </div>
    <div class="panel-body">
        <div style="margin-bottom: 3px">
            <button class="btn btn-info" onClick=swal("ยืนยันการสั่งแลป")><i class="fa fa-check"></i> สั่งแลป</button>
            <hr>
        <div id="grid-view-data-table" class="grid-view">
        <table class="table table-striped table-bordered">
            <thead>
                <tr>
                    <th></th>
                    <th>#</th>
                    <th>รายการแลป</th>
                    <th>วันที่รายงานผล</th>
                    <th>ผลแลป</th>
                    <th>หมายเหตุ</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                <tr data-key="0">
                    <td><input type="checkbox" name="selection[]" value="0"></td>
                    <td>1</td>
                    <td>Creatinine</td>
                    <td><input type="date" name="date_order"></td>
                    <td><input type="text" name="result_order"></td>
                    <td>-</td>
                    <td><button class="btn btn-danger" onClick=swal("ยืนยันการยกเลิกรายการแลป")><i class="fa fa-trash"></i></button></td>
                </tr>
                <tr data-key=1">
                    <td><input type="checkbox" name="selection[]" value="1"></td>
                    <td>2</td>
                    <td>Urine creatinine</td>
                    <td><input type="date" name="date_order"></td>
                    <td><input type="text" name="result_order"></td>
                    <td>mg/dl.</td>
                    <td><button class="btn btn-danger" onClick=swal("ยืนยันการยกเลิกรายการแลป")><i class="fa fa-trash"></i></button></td>
                </tr>
                <tr data-key=2">
                    <td><input type="checkbox" name="selection[]" value="2"></td>
                    <td>3</td>
                    <td>PH.</td>
                    <td><input type="date" name="date_order"></td>
                    <td><input type="text" name="result_order"></td>
                    <td>mg/dl.</td>
                    <td><button class="btn btn-danger" onClick=swal("ยืนยันการยกเลิกรายการแลป")><i class="fa fa-trash"></i></button></td>
                </tr>
                <tr data-key=3">
                    <td><input type="checkbox" name="selection[]" value="3"></td>
                    <td>4</td>
                    <td>Uric acid.</td>
                    <td><input type="date" name="date_order"></td>
                    <td><input type="text" name="result_order"></td>
                    <td>Normal 5.0-8.0</td>
                    <td><button class="btn btn-danger" onClick=swal("ยืนยันการยกเลิกรายการแลป")><i class="fa fa-trash"></i></button></td>
                </tr>
                <tr data-key=4">
                    <td><input type="checkbox" name="selection[]" value="4"></td>
                    <td>5</td>
                    <td>HDL</td>
                    <td><input type="date" name="date_order"></td>
                    <td><input type="text" name="result_order"></td>
                    <td>Normal 35-88</td>
                    <td><button class="btn btn-danger" onClick=swal("ยืนยันการยกเลิกรายการแลป")><i class="fa fa-trash"></i></button></td>
                </tr>
            </tbody>
        </table>
    </div>
    <?php Pjax::end(); ?>
</div>

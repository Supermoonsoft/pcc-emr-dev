<?php

use yii\helpers\Url;

$module = \Yii::$app->controller->module->id;

?>

<div style="width: 100%; margin-top: 0px;box-shadow: 5px 3px 2px grey;" >

    <div class="container-fluid">
        <div class="navbar-header">
            <ul class="nav navbar-nav na">
                
                <li>
                    <?php if ($module == 'queuemanage'): ?>
                        <a style="background-color: #eee" title="Q. Manage" href="<?= Url::to(['/queuemanage']) ?>"><i class="fa fa-child" aria-hidden="true"></i> QUEUE</a>
                    <?php else: ?>
                        <a title="Q. Manage" href="<?= Url::to(['/queuemanage']) ?>"><i class="fa fa-child" aria-hidden="true"></i> QUEUE</a>
                    <?php endif; ?>
                </li>  
               
                <li>
                    <?php if ($module == 'doctorworkbench'): ?>
                        <a style="background-color: #eee" title="Doctor-Order/Today" href="<?= Url::to(['/doctorworkbench/pcc-diagnosis']) ?>"><i class="fa fa-stethoscope"></i> Order</a>
                    <?php else: ?>
                        <a title="Doctor-Order/Today" href="<?= Url::to(['/doctorworkbench/pcc-diagnosis']) ?>"><i class="fa fa-stethoscope"></i> ORDER</a>
                    <?php endif; ?>
                </li>

                <li>
                    <a title="Appointment" href="<?= Url::to(['/appoint']) ?>"><i class="fa fa-calendar" aria-hidden="true"></i>  APPOINT</a><!-- POND -->
                </li>  
                <li>
                    <a title="Print-Out" href="<?= Url::to(['/print-out']) ?>"><i class="fa fa-print"></i> PRINT</a>
                </li>
                <li>
                    <a title="Report" href="<?= Url::to(['/report']) ?>"><i class="fa fa-file-o" aria-hidden="true"></i> REPORT</a>
                </li>
                <li>
                    <a title="PCC-STOCK" href="<?= Url::to(['/stock']) ?>"><i class="fa fa-table" aria-hidden="true"></i> STOCK</a>
                </li>
                <li>
                    <a title="งานบัญชี" href="#"><i class="fa fa-dollar" aria-hidden="true"></i> งานบัญชี</a>
                </li>
            </ul>

        </div>
    </div>
</div>


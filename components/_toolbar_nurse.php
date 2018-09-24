<?php

use yii\helpers\Url;

$module = \Yii::$app->controller->module->id;
?>

<div style="width: 100%; margin-top: 0px;box-shadow: 5px 3px 2px grey;" >

    <div class="container-fluid">
        <div class="navbar-header">
            <ul class="nav navbar-nav na">

                <li>
                    <a class="<?= $module == 'queuemanage' ? 'on-active' : 'non-active' ?>" title="Queue Manage" href="<?= Url::to(['/queuemanage']) ?>"><i class="fa fa-child" aria-hidden="true"></i> QUEUE</a>
                </li> 
                <li>
                    <a class="<?= $module == 'doctorworkbench' ? 'on-active' : 'non-active' ?>" title="Doctor-Order/Today" href="<?= Url::to(['/doctorworkbench/order']) ?>"><i class="fa fa-stethoscope"></i> ORDER</a>
                </li>
               
                <li>
                    <a class="<?= $module == 'printout' ? 'on-active' : 'non-active' ?>" title="Print-Out" href="<?= Url::to(['/printout']) ?>"><i class="fa fa-print"></i> PRINT</a>
                </li>
                <li>
                    <a class="<?= $module == 'report' ? 'on-active' : 'non-active' ?>" title="Report" href="<?= Url::to(['/report']) ?>"><i class="fa fa-file-o" aria-hidden="true"></i> REPORT</a>
                </li>
                
                <li>
                    <a class="<?= $module == 'stock' ? 'on-active' : 'non-active' ?>" title="PCC-STOCK" href="<?= Url::to(['/stock/pcc-service-medication/dispen']) ?>"><i class="fa fa-table" aria-hidden="true"></i> STOCK</a>
                </li>
                <li>
                    <a class="<?= $module == 'account' ? 'on-active' : 'non-active' ?>" title="งานบัญชี" href="#"><i class="fa fa-dollar" aria-hidden="true"></i> งานบัญชี</a>
                </li>
            </ul>

        </div>
    </div>
</div>


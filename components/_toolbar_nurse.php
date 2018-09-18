<?php

use yii\helpers\Url;
?>

<div style="width: 100%; margin-top: 0px;box-shadow: 5px 3px 2px grey;" >

    <div class="container-fluid">
        <div class="navbar-header">
            <ul class="nav navbar-nav na">



                <li>
                    <a title="Q. Manage" href="<?= Url::to(['/queue-manage']) ?>"><i class="fa fa-child" aria-hidden="true"></i> QUEUE</a>
                </li>  
                <li>
                    <a title="Hospital Lab Result" href="<?= Url::to(['/lab/hoslab']) ?>"><i class="fa fa-flask" aria-hidden="true"></i> LAB</a><!-- POND -->
                </li>

                <li>
                    <a title="Drug" href="<?= Url::to(['/drug/hosdrug']) ?>"><i class="fa fa-plus-square" aria-hidden="true"></i>  Drug</a><!-- POND -->
                </li>

                <li>
                    <a title="PCC EMR" href="<?= Url::to(['/emr']) ?>"><i class="fa fa-address-card" aria-hidden="true"></i>  EMR</a><!-- POND -->
                </li>  



                <li>
                    <a title="Doctor-Order/Today" href="<?= Url::to(['/doctorworkbench/order']) ?>"><i class="fa fa-stethoscope"></i> Order</a><!-- POND -->
                </li>

                <li>
                    <a title="Appointment" href="<?= Url::to(['/appoint']) ?>"><i class="fa fa-calendar" aria-hidden="true"></i>  Appoint</a><!-- POND -->
                </li>  
                <li>
                    <a title="Print-Out" href="<?= Url::to(['/print-out']) ?>"><i class="fa fa-print"></i> Print</a>
                </li>
                <li>
                    <a title="Report" href="<?= Url::to(['/report']) ?>"><i class="fa fa-file-o" aria-hidden="true"></i> Report</a>
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


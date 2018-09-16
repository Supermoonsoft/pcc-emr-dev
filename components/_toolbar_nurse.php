<?php

use yii\helpers\Url;
?>

<div style="width: 100%; margin-top: 0px;box-shadow: 5px 3px 2px grey;" >

    <div class="container-fluid">
        <div class="navbar-header">
            <ul class="nav navbar-nav na">

                <li>
                    <a title="PCC EMR" href="<?= Url::to(['/emr']) ?>"><i class="fa fa-wheelchair"></i>  EMR</a><!-- POND -->
                </li>              
                <li>
                    <a title="Appointment" href="<?= Url::to(['/appoint']) ?>"><i class="fa fa-bullhorn"></i> Appoint</a>
                </li>
                <li>
                    <a title="Labs" href="<?= Url::to(['/lab/hoslab']) ?>"><i class="fa fa-server"></i> Lab</a>
                </li>
                <li>
                    <a title="Drugs" href="<?= Url::to(['/drug/hosdrug']) ?>"><i class="fa fa-stethoscope"></i> Drug</a><!-- POND -->
                </li>
                <li>
                    <a title="Doctor Note" href="<?= Url::to(['/doctor-note']) ?>"><i class="fa fa-pencil-square-o"></i> Note</a>
                </li>
                <li>
                    <a title="PACs View" href="<?= Url::to(['pacs-view']) ?>"><i class="fa fa-xing-square"></i> PACs</a>

                </li>
                <li>
                    <a title="Document" href="<?= Url::to(['/document']) ?>"><i class="fa fa-archive"></i> Doc</a>
                </li>
                <li>
                    <a title="Print-Out" href="<?= Url::to(['/print-out']) ?>"><i class="fa fa-print"></i> Print</a>
                </li>
                <li>
                    <a title="Report" href="<?= Url::to(['/report']) ?>"><i class="fa fa-reply-all"></i> Report</a>
                </li>
                <li>
                    <a title="Q. Manage" href="<?= Url::to(['/queue-manage']) ?>"><i class="fa fa-clipboard"></i> Q. Manage</a>
                </li>
                <li>
                    <a title="Notification Setting" href="<?= Url::to(['/notify-setting']) ?>"><i class="fa fa-support"></i> Notify</a>
                </li>
                <li>
                    <a title="PCC-STOCK" href="<?= Url::to(['/stock']) ?>"><i class="fa fa-file-text"></i> STOCK</a>
                </li>
            </ul>

        </div>
    </div>
</div>


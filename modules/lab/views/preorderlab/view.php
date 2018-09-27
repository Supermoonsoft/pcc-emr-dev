<?php

use yii\widgets\DetailView;
use app\components\loading\ShowLoading;
use app\components\PatientHelper;
use app\components\MessageHelper;
$hn = PatientHelper::getCurrentHn();
$vn = PatientHelper::getCurrentVn();
//$Sdate = PatientHelper::getDateVisitByVn($vn);
//$Stime = PatientHelper::getTimeVisitByVn($vn);

//$this->params['pt_title'] = PatientHelper::getPatientTitleByHn($hn);
?>
<div class="preorderlab-view">
 
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'pcc_vn',
            'data_json',
            'pcc_start_service_datetime',
            'pcc_end_service_datetime',
            'data1',
            'data2',
            'hospcode',
            'lab_code',
            'lab_name',
            'lab_request_date',
            'lab_result_date',
            'lab_result',
            'standard_result',
            'lab_price',
            'lab_code_moph',
            'last_update',
        ],
    ]) ?>

</div>

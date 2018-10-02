<?php

use yii\helpers\Html;
use app\components\loading\ShowLoading;
use app\components\PatientHelper;
use app\components\MessageHelper;
$hn = PatientHelper::getCurrentHn();
$vn = PatientHelper::getCurrentVn();
//$Sdate = PatientHelper::getDateVisitByVn($vn);
//$Stime = PatientHelper::getTimeVisitByVn($vn);

//$this->params['pt_title'] = PatientHelper::getPatientTitleByHn($hn);

?>
<div class="preorderlab-create">
    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>
</div>

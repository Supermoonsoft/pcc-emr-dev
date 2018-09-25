<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\modules\appointment\models\GatewayEmrAppointment */

$this->title = 'Create Gateway Emr Appointment';
$this->params['breadcrumbs'][] = ['label' => 'Gateway Emr Appointments', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="gateway-emr-appointment-create">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>

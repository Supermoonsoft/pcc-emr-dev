<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\modules\appointment\models\GatewayEmrAppointment */

$this->title = 'Update Gateway Emr Appointment: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Gateway Emr Appointments', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="gateway-emr-appointment-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>

<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\modules\appointment\models\GatewayEmrAppointment */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Gateway Emr Appointments', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="gateway-emr-appointment-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'provider_code',
            'provider_name',
            'hn',
            'vn',
            'an',
            'date_visit',
            'time_visit',
            'clinic',
            'appoint_date',
            'appoint_time',
            'appoint_detail',
            'data_json',
            'last_update',
        ],
    ]) ?>

</div>

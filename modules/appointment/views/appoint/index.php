<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel app\modules\appointment\models\GatewayEmrAppointmentSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Gateway Emr Appointments';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="gateway-emr-appointment-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php Pjax::begin(); ?>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Gateway Emr Appointment', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'provider_code',
            'provider_name',
            'hn',
            'vn',
            //'an',
            //'date_visit',
            //'time_visit',
            //'clinic',
            //'appoint_date',
            //'appoint_time',
            //'appoint_detail',
            //'data_json',
            //'last_update',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
    <?php Pjax::end(); ?>
</div>

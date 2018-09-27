<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel app\modules\lab\models\PcclabSeach */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Pcclabs';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="pcclab-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php Pjax::begin(); ?>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Pcclab', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            //'id',
            //'hn',
            //'vn',
            //'provider_code',
            //'provider_name',
            //'date_service',
            //'time_service',
            'lab_code',
            'lab_name',
            'standard_result',
            //'lab_request_at',
            'lab_result_date',
            //'data_json',
            //'last_update',
            //'lab_result',

            //['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
    <?php Pjax::end(); ?>
</div>

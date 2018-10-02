<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel app\modules\lab\models\PreorderlabSeach */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Preorderlabs';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="preorderlab-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php Pjax::begin(); ?>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Preorderlab', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'cid',
            'hos_hn',
            'hos_vn',
            'hos_date_visit',
            //'lab_code_hos',
            //'lab_code_moph',
            //'lab_name_hos',
            //'request_at',
            //'result_at',
            //'data_json',
            //'lab_name_moph',
            //'hos_result',
            //'lab_normal',
            //'lab_possible',
            //'lab_range_min',
            //'lab_range_max',
            //'lab_range_female_min',
            //'lab_range_female_max',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
    <?php Pjax::end(); ?>
</div>

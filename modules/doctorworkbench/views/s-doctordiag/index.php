<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\modules\doctorworkbench\models\SDoctordiagSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Sdoctordiags';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="sdoctordiag-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Sdoctordiag', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'vn',
            'hn',
            'vstdate',
            'vsttime',
            //'diagtype',
            //'diagcode',
            //'icd10',
            //'userid_doctor',
            //'data_json',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>

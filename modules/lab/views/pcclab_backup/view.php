<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\modules\lab\models\Pcclab */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Pcclabs', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="pcclab-view">

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
            'hn',
            'vn',
            'provider_code',
            'provider_name',
            'date_service',
            'time_service',
            'lab_code',
            'lab_name',
            'standard_result',
            'lab_request_at',
            'lab_result_at',
            'data_json',
            'last_update',
            'lab_result',
        ],
    ]) ?>

</div>

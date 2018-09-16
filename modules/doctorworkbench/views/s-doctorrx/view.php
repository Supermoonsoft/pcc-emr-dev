<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\modules\doctorworkbench\models\SDoctorrx */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Sdoctorrxes', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="sdoctorrx-view">

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
            'vn',
            'hn',
            'an',
            'vstdate',
            'vsttime',
            'drugcode',
            'use_id',
            'qty',
            'unitprice',
            'costprice',
            'totalprice',
            'userid_doctor',
            'data_json',
        ],
    ]) ?>

</div>

<?php

use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\modules\stock\models\PccServiceMedication */
?>
<div class="pcc-service-medication-view">
 
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'vn',
            'hn',
            'an',
            'icode',
            'qty',
            'unitprice',
            'druguse',
            'costprice',
            'totalprice',
            'provider_code',
            'provider_name',
            'date_service',
            'time_service',
            'data_json',
            'unit',
            'tmt24_code',
            'usage_line1',
            'usage_line2',
            'usage_line3',
            'drug_name',
            'hoscode',
        ],
    ]) ?>

</div>

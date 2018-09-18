<?php

use yii\helpers\Html;
use yii\helpers\Url;
use kartik\grid\GridView;
use yii\widgets\Pjax;

$this->title = 'Diagnoses';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="pcc-diagnosis-index" >
<div style="margin-bottom:20px;">
</div>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            [
                'class' => 'kartik\grid\CheckboxColumn',
                'width' => '36px',
                'headerOptions' => ['class' => 'kartik-sheet-style'],
            ],
            [
                'attribute' => 'icd_code',
                'header' => 'ICD10',
                'width' => '10%',
            ],
            [
                'attribute' => 'icd_name',
                'header' => 'ชื่อโรค',
                'width' => '60%',
            ],
            [
                'attribute' => 'diag_type',
                'header' => 'ประเภท',
                'hAlign' => 'center',
                'vAlign' => 'middle',
                'width' => '5%',
            ],
            [
                'attribute' => 'provider_name',
                'header' => 'แพทย์',
                'width' => '15%',
            ],

            [
                'class' => 'yii\grid\ActionColumn',
                'template'=>'{delete}',
                'buttons' => [
                    'delete' => function ($url) {
                        return Html::a(Yii::t('yii', 'Delete'), '#', [
                            'title' => Yii::t('yii', 'Delete'),
                            'aria-label' => Yii::t('yii', 'Delete'),
                            'onclick' => "
                                if (confirm('ok?')) {
                                    $.ajax('$url', {
                                        type: 'POST'
                                    }).done(function(data) {
                                        $.pjax.reload({container: '#pjax-container'});
                                    });
                                }
                                return false;
                            ",
                        ]);
                    },
                ],
            ],
        ],
    ]); ?>

</div>

<?php
use yii\helpers\Html;
use yii\helpers\Url;

return [
    [
        'class' => 'kartik\grid\RadioColumn',
        'width' => '20px',
        'radioOptions' => function ($model) {
            return [
                'value' => $model->id,
                'checked' => $model->id == Yii::$app->request->get('id'),
                'onclick'=> 'window.location.href = "'.Url::to(['/doctorworkbench/pcc-procedure','id' => $model->id]).'"'
            ];
        }
    ],
    [
        'class' => 'kartik\grid\SerialColumn',
        'width' => '30px',
    ],
    [
        'class'=>'\kartik\grid\DataColumn',
        'header' => 'Procedure Name',
        'attribute'=>'procedure_name',
        'value' => function($model){
            return $model->proced->title.' - '.$model->proced->title_th;
        }
    ],

    [
        'class'=>'\kartik\grid\DataColumn',
        'header' => 'Doctor',
        'attribute'=>'doctor',
    ],
    [
        'class' => 'kartik\grid\ActionColumn',
        'header' => 'Action',
        'template' => '{delete}',
        'buttons' => [
            'delete' => function ($url) {
                return Html::a('<i class="far fa-trash-alt"></i> ', '#', [
                    'title' => Yii::t('yii', 'Delete'),
                    'class' => '',
                    'aria-label' => Yii::t('yii', 'Delete'),
                    'onclick' => "
                        // if (confirm('ok?')) {
                            $.ajax('$url', {
                                type: 'POST'
                            }).done(function(data) {
                                $.pjax.reload({container: '#crud-procedure-pjax'});
                            });
                        // }
                        return false;
                    ",
                ]);
            },
        ],
    ],

];   
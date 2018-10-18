<?php
use yii\helpers\Html;
use yii\helpers\Url;

return [
    [
        'class' => 'kartik\grid\CheckboxColumn',
        'width' => '20px',
    ],
    [
        'class' => 'kartik\grid\SerialColumn',
        'width' => '30px',
    ],
    [
        'class'=>'\kartik\grid\DataColumn',
        'attribute'=>'procedure_name',
        'value' => function($model){
            return $model->proced->title_th;
        }
    ],

    [
        'class'=>'\kartik\grid\DataColumn',
        'attribute'=>'doctor',
    ],
    [
        'class' => 'kartik\grid\ActionColumn',
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
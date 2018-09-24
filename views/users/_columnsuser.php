<?php
use yii\helpers\Url;
use yii\helpers\Html;

return [
    [
        'class' => 'kartik\grid\CheckboxColumn',
        'width' => '20px',
    ],
    [
        'class' => 'kartik\grid\SerialColumn',
        'width' => '30px',
    ],
        // [
        // 'class'=>'\kartik\grid\DataColumn',
        // 'attribute'=>'id',
    // ],
    [
        'class'=>'\kartik\grid\DataColumn',
        'attribute'=>'username',
    ],
     [
        'class' => '\kartik\grid\DataColumn',
        'attribute' => 'name',
        'value' => function($model) {
            if ($model->name != '') {
                return $model->pname . '' . $model->name;
            } else {
                return'';
            }
        },
    ],
//    [
//        'class'=>'\kartik\grid\DataColumn',
//        'attribute'=>'email',
//    ],
//    [
//        'class'=>'\kartik\grid\DataColumn',
//        'attribute'=>'password_hash',
//    ],
//    [
//        'class'=>'\kartik\grid\DataColumn',
//        'attribute'=>'auth_key',
//    ],
//    [
//        'class'=>'\kartik\grid\DataColumn',
//        'attribute'=>'confirmed_at',
//    ],
    // [
        // 'class'=>'\kartik\grid\DataColumn',
        // 'attribute'=>'unconfirmed_email',
    // ],
    // [
        // 'class'=>'\kartik\grid\DataColumn',
        // 'attribute'=>'blocked_at',
    // ],
    // [
        // 'class'=>'\kartik\grid\DataColumn',
        // 'attribute'=>'registration_ip',
    // ],
    // [
        // 'class'=>'\kartik\grid\DataColumn',
        // 'attribute'=>'created_at',
    // ],
    // [
        // 'class'=>'\kartik\grid\DataColumn',
        // 'attribute'=>'updated_at',
    // ],
    // [
        // 'class'=>'\kartik\grid\DataColumn',
        // 'attribute'=>'flags',
    // ],
    // [
        // 'class'=>'\kartik\grid\DataColumn',
        // 'attribute'=>'last_login_at',
    // ],
    // [
        // 'class'=>'\kartik\grid\DataColumn',
        // 'attribute'=>'status',
    // ],
    // [
        // 'class'=>'\kartik\grid\DataColumn',
        // 'attribute'=>'password_reset_token',
    // ],
//     [
//         'class'=>'\kartik\grid\DataColumn',
//         'attribute'=>'pname',
//     ],
//     [
//         'class'=>'\kartik\grid\DataColumn',
//         'attribute'=>'name',
//     ],
//     [
//        'class' => '\kartik\grid\DataColumn',
//        'attribute' => 'dep_id',        
//    ],
//    [
//        'class' => '\kartik\grid\DataColumn',
//        'attribute' => 'occ_id',
//        'value' => function($model) {
//            $models = app\models\Occupations::find()->where(['id' => $model->occ_id])->one();
//            //return $model->name;
//
//            if ($model->occ_id != '') {
//                return $models->name;
//            } else {
//                return'';
//            }
//        },
//    ],
//     [
//         'class'=>'\kartik\grid\DataColumn',
//         'attribute'=>'occ_no',
//     ],
//    [
//        'class' => '\kartik\grid\DataColumn',
//        'attribute' => 'pos_id',
//        'value' => function($model) {
//            $models = app\models\Positions::find()->where(['id' => $model->pos_id])->one();
//            //return $model->name;
//
//            if ($model->pos_id != '') {
//                return $models->name;
//            } else {
//                return'';
//            }
//        },
//    ],

    [
        'class' => '\kartik\grid\DataColumn',
        'attribute' => 'role',
        'header'=>'ระดับผู้ใช้งาน',
        'value' => function($model) {
            if ($model->role == 10) {
                return 'Admin';
            }
            if ($model->role == 20) {
                return 'Doctor';
            }
            if ($model->role == 30) {
                return 'Nurse';
            }
            if ($model->role == 40) {
                return 'Phar';
            }
            if ($model->role == 50) {
                return 'Dent';
            }
            if ($model->role == 60) {
                return 'Sasuk';
            }
        }
    ],
    [
        'class' => 'kartik\grid\ActionColumn',
        'contentOptions' => [
            'noWrap' => true
        ],
        'width' => '120px',
        'template' => '{view} {updateuser}',
        'buttons' => [
            'view' => function($url, $model, $key) {
                return Html::a('<i class="glyphicon glyphicon-search"></i>', $url, ['class' => 'btn btn-default', 'role' => 'modal-remote', 'title' => 'ดู']);
            },
            'updateuser' => function($url, $model, $key) {
                return Html::a('<i class="glyphicon glyphicon-edit"></i>', ['/users/updateuser','id'=>$model->id], [
                            'class' => 'btn btn-default',
                            'role' => 'modal-remote',
                            'title' => 'แก้ไข'
                ]);
            },
//                    'delete'=>function($url,$model,$key){
//                         return Html::a('<i class="glyphicon glyphicon-trash"></i>', $url,[
//                                'title' => Yii::t('yii', 'Delete'),
//                                'data-confirm' => Yii::t('yii', 'คุณต้องการลบไฟล์นี้?'),
//                                'data-method' => 'post',
//                                'data-pjax' => '0',
//                                'class'=>'btn btn-default'
//                                ]);
//                    }
        ]
    ],

];   
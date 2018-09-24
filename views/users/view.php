<?php

use yii\widgets\DetailView;
use yii\helpers\Html;

?>
<div class="users-view">

    <?=
    DetailView::widget([
        'model' => $model,
        'formatter' => ['class' => 'yii\i18n\Formatter','nullDisplay' => '-'],   
        'attributes' => [
            //'id',
            [
                'class' => '\kartik\grid\DataColumn',
                'attribute' => 'username',
                'header'=>'รหัสผู้ใช้งาน',
            ],
            [
                'class' => '\kartik\grid\DataColumn',
                'attribute' => 'email',
                'header' => 'อิเมล์'
            ],
//            'password_hash',
//            'auth_key',
//            'confirmed_at',
//            'unconfirmed_email:email',
//            'blocked_at',
//            'registration_ip',
//            'created_at',
//            'updated_at',
//            'flags',
//            'last_login_at',
//            'status',
//            'password_reset_token',
            [
                'class' => '\kartik\grid\DataColumn',
                'attribute' => 'name',
                'value' => function($model) {
                    return $model->pname . '' . $model->name;
                },
            ],
//            'dep_id',
//            'occ_id',
            'occ_no',
//            'pos_id',
//            'pos_no',
            [
                'class' => '\kartik\grid\DataColumn',
                'attribute' => 'role',
                'header' => 'ระดับผู้ใช้งาน',
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
        ],
    ])
    ?>

</div>

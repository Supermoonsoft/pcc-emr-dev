<p>กรุณาเลือกผู้รับบริการ</p>
<?php
use yii\grid\GridView;
use yii\helpers\Html;


echo GridView::widget([
    'dataProvider'=>$dataProvider,
    'columns'=>[
        'hn:text:HN',
        'cid:text:เลขบัตร',
        'fullname:text:ชื่อ สกุล',
        'birthday:date:วดป.เกิด',
        'agey:integer:อายุ(ปี)',
        [
            'label'=>'',
            'format'=>'raw',
            'value'=>function($model){
                return Html::a('ส่งคิวบริการ',['/setsession/default/skip-queue','cid'=>$model['cid']],['class'=>'btn btn-info','data-confirm'=>'ยืนยัน']);
            }
        ]
    ]
]);



<?php
use yii\helpers\Url;
use yii\helpers\Html;
use yii\bootstrap\Modal;
use kartik\grid\GridView;
use johnitvn\ajaxcrud\CrudAsset; 
use johnitvn\ajaxcrud\BulkButtonWidget;
use app\models\UsersSearch;


$this->title = 'Users';
$this->params['breadcrumbs'][] = $this->title;

CrudAsset::register($this);

?>
<?php echo 
Html::a('<i class="glyphicon glyphicon-plus"></i>',
                    ['/user/admin/create'],
                    ['role'=>'_modal-remote','title'=> 'เพิ่มผู้ใช้','class'=>'btn btn-success'])

?>
<?php echo 
Html::a('<i class="glyphicon glyphicon-edit"></i><i class="glyphicon glyphicon-user"></i>',
                    ['/user/admin/index'],
                    ['role'=>'_modal-remote','title'=> 'แก้ไขรหัสผ่าน ผู้ใช้งาน','class'=>'btn btn-warning'])

?>
<div class="users-index">
    <div id="ajaxCrudDatatable">
        <?=GridView::widget([
            'id'=>'crud-datatable',
            'dataProvider' => $dataProvider,
            'formatter' => ['class' => 'yii\i18n\Formatter','nullDisplay' => '-'],   
            //'filterModel' => $searchModel,
            'pjax'=>true,
            'columns' => require(__DIR__.'/_columnsuser.php'),
            'toolbar'=> [
//                ['content'=>
//                    Html::a('<i class="glyphicon glyphicon-plus"></i>', ['create'],
//                    ['role'=>'modal-remote','title'=> 'Create new Users','class'=>'btn btn-default']).
//                    Html::a('<i class="glyphicon glyphicon-repeat"></i>', [''],
//                    ['data-pjax'=>1, 'class'=>'btn btn-default', 'title'=>'Reset Grid']).
//                    '{toggleData}'.
//                    '{export}'
//                ],
            ],          
            'striped' => false,
            'hover'=>true,
            'summary'=>false,
            'condensed' => true,
            'responsive' => true,          
            'panel' => [
                'type' => 'info', 
                'heading' => '<i class="glyphicon glyphicon-list"></i> ข้อมูลผู้ใช้งาน',
                'before'=>'<code>* ข้อมูลส่วนตัว โปรดกรอกข้อมูลทีเป็นความจริง และตรวจสอบให้เป็นปัจจุบัน</code>',
//                'after'=>BulkButtonWidget::widget([
//                            'buttons'=>Html::a('<i class="glyphicon glyphicon-trash"></i>&nbsp; Delete All',
//                                ["bulk-delete"] ,
//                                [
//                                    "class"=>"btn btn-danger btn-xs",
//                                    'role'=>'modal-remote-bulk',
//                                    'data-confirm'=>false, 'data-method'=>false,// for overide yii data api
//                                    'data-request-method'=>'post',
//                                    'data-confirm-title'=>'Are you sure?',
//                                    'data-confirm-message'=>'Are you sure want to delete this item'
//                                ]),
//                        ]).                        
                        '<div class="clearfix"></div>',
            ]
        ])?>
    </div>
</div>
<?php Modal::begin([
    "id"=>"ajaxCrudModal",
    "footer"=>"",// always need it for jquery plugin
])?>
<?php Modal::end(); ?>

<?php
use yii\helpers\Html;
use kartik\grid\GridView;
?>
<div class="panel panel-info">
    <div class="panel-heading">
        <div class="panel-title">
            <i class="fa fa-clock-o" aria-hidden="true"></i> ผู้ป่วยรอส่งเข้าพบแพทย์ 
            <object align='right' style="margin-top: -5px;">
            <?= Html::a('กลับ', 
                // ['/queuemanage/pcc-visit'], [
                ['/queuemanage'], [
                'class' => 'btn btn-lbrown',
            ]) ?>
            </object>
        </div>
    </div>
    <div class="panel-body">
<?php
echo $this->render('_search', ['model' => $searchModel]);
echo GridView::widget([
    'dataProvider'=> $dataProvider,
    'columns' => require(__DIR__ . '/_columns.php'),
    'responsive'=>true,
    'hover'=>true,
    'pjax' =>true, 
    'summary' => false,
]);
?>
 </div>
<?php

use yii\helpers\Html;
use kartik\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel app\modules\drug\models\HosdrugSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'รายการยา';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="hosdrug-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php Pjax::begin(); ?>
    <?php  echo $this->render('_search', ['model' => $searchModel]); ?>


<?= GridView::widget([
        'dataProvider' => $dataProvider,
        //'filterModel' => $searchModel,
        //'showPageSummary'=>true,
        'pjax'=>true,
        'striped'=>true,
        'hover'=>true,
        'panel'=>['type'=>'primary', 'heading'=> 'DRUG ITEMs'],
        'columns' => [
            [
                'attribute'=>'hos_date_visit', 
                'width'=>'310px',
                'value'=>function ($model, $key, $index, $widget) { 
                    return $model->hos_date_visit;
                },
                //'filterType'=>GridView::FILTER_SELECT2,
                //'filter'=>ArrayHelper::map(Suppliers::find()->orderBy('company_name')->asArray()->all(), 'id', 'company_name'), 
                //'filterWidgetOptions'=>[
                //    'pluginOptions'=>['allowClear'=>true],
                // ],
                //'filterInputOptions'=>['placeholder'=>'Any supplier'],
                'group'=>true,  // enable grouping,
                'groupedRow'=>true,                    // move grouped column to a single grouped row
                'groupOddCssClass'=>'kv-grouped-row',  // configure odd group cell css class
                'groupEvenCssClass'=>'kv-grouped-row', // configure even group cell css class
            ],
            [
                'attribute'=>'cid', 
                'width'=>'310px',
                'value'=>function ($model, $key, $index, $widget) { 
                    return $model->cid;
                },
                'group'=>true, 
                'groupedRow'=>true,
            ],
            ['class' => 'yii\grid\SerialColumn'],
            'drug_code_hos',
            'drug_name_hos',
            'drug_pay_amount',
            'drug_pay_unit',
            //'data_json',
            //'drug_code_moph',
            //'drug_name_moph',

            //['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
    <?php Pjax::end(); ?>
</div>



<?php

use yii\helpers\Html;
use kartik\grid\GridView;
use yii\widgets\Pjax;
use app\components\DbHelper;
use yii\web\JsExpression;
use app\components\loading\ShowLoading;
use yii\helpers\Url;

//echo ShowLoading::widget();
?>
<div class="hoslab-index">

    <div style="margin-bottom: 3px">
<?php $alert = 'swal("ส่งทีละหลายรายการ...")'; ?>
        
    </div>
    <?php Pjax::begin(); ?>
    <?=
    GridView::widget([
        'dataProvider' => $dataProvider,
        //'filterModel' => $searchModel,
        //'showPageSummary'=>true,
        'pjax' => true,
        'pjaxSettings' => [
            'neverTimeout' => true,
        ],
        'striped' => true,
        'hover' => true,
        'columns' => [
            [
                'class' => 'kartik\grid\ExpandRowColumn',
                'width' => '100px',
                'value' => function ($model, $key, $index, $column) {
                    return GridView::ROW_COLLAPSED;
                },
                'detail' => function ($model, $key, $index, $column) {
                    
                    //return Yii::$app->controller->renderPartial('test', ['provider_code' => $model->provider_code,'vn'=>$model->vn]);

                    //return Yii::$app->controller->renderPartial('emrdetail', 
//                            ['provider_code' => $model->provider_code,
//                             'vn'=>$model->vn]);
                    
                      
                    //return Yii::$app->controller->renderPartial('_detail_orden_pago' ['ordenPagoModel' => $ordenPagoModel]);
                    return $this->render('../emrdetail/detail', ['id' => $model->id,'vn'=>$model->vn,'provider_code'=>$model->provider_code]);
                },
                'headerOptions' => ['class' => 'kartik-sheet-style'],
                'expandOneOnly' => true
            ],
            [
                'attribute' => 'date_service',
                'label'=>'วันที่มารับบริการ -> สถานที่รับบริการ',
                'value' => function ($model, $key, $index, $widget) {
                     $tyear = Yii::$app->formatter->asDate($model->date_service, 'yyyy')+543;
                     return Yii::$app->formatter->asDate($model->date_service, 'dd/MM/').$tyear . ' ----- ' . $model->provider_name;
                },
                'filter' => false,
            ],
        /* [
          'attribute' => 'date_service',
          'value' => function ($model, $key, $index, $widget) {
          return $model->date_service . ' ' . $model->provider_name;
          },
          'filter' => false,
          //'filterType'=>GridView::FILTER_SELECT2,
          //'filter'=>ArrayHelper::map(Suppliers::find()->orderBy('company_name')->asArray()->all(), 'id', 'company_name'),
          //'filterWidgetOptions'=>[
          //    'pluginOptions'=>['allowClear'=>true],
          // ],
          //'filterInputOptions'=>['placeholder'=>'Any supplier'],
          'group' => true, // enable grouping,
          'groupedRow' => true, // move grouped column to a single grouped row
          'groupOddCssClass' => 'kv-grouped-row', // configure odd group cell css class
          'groupEvenCssClass' => 'kv-grouped-row', // configure even group cell css class
          ],
          ['class' => 'yii\grid\CheckboxColumn',],
          'cc',
          'pe', */
        ],
    ]);
    ?>
    <?php Pjax::end(); ?>

</div>


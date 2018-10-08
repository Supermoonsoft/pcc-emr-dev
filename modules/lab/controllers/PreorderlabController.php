<?php

namespace app\modules\lab\controllers;

use Yii;
use app\modules\lab\models\Preorderlab;
use app\modules\lab\models\PreorderlabSearch;
use app\modules\lab\models\Pcclab;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use \yii\web\Response;
use app\components\PatientHelper;
/**
 * PreorderlabController implements the CRUD actions for Preorderlab model.
 */
class PreorderlabController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                    'bulk-delete' => ['post'],
                ],
            ],
        ];
    }

    /**
     * Lists all Preorderlab models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new PreorderlabSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Preorderlab model.
     * @param string $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Preorderlab model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Preorderlab();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Preorderlab model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param string $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Preorderlab model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param string $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Preorderlab model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $id
     * @return Preorderlab the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Preorderlab::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }

    public function actionBulkDelete()
    {        
        $request = Yii::$app->request;
        $pks = explode(',', $request->post( 'pks' )); // Array or selected records primary keys
        foreach ( $pks as $pk ) {
            $model = $this->findModel($pk);
            $model->delete();
        }

        if($request->isAjax){
            /*
            *   Process for ajax request
            */
            Yii::$app->response->format = Response::FORMAT_JSON;
            return ['forceClose'=>true,'forceReload'=>'#pre-order-lab-pjax'];
        }else{
            /*
            *   Process for non-ajax request
            */
            return $this->redirect(['index']);
        }
       
    }

    
public function actionReLab(){
    $request = Yii::$app->request;
    if($request->isPost){
    \Yii::$app->response->format = Response::FORMAT_JSON;
    $cid = PatientHelper::getCurrentCid();
    $pcc_vn = PatientHelper::getCurrentVn();
    $id = $request->post( 'id' );
    $pks = explode(',', $request->post( 'id' )); // Array or selected records primary keys

      $order = Pcclab::find()->where(['id' => $id])->one();
       $model = new Preorderlab();  
      $model->hn =  $order->hn;
      $model->vn =  $order->vn;
      $model->pcc_vn =  $pcc_vn;
      $model->cid =  $order->cid;
      $model->hospcode = $order->hospcode;
      $model->lab_code = $order->lab_code;
      $model->lab_name = $order->lab_name;
      $model->lab_request_date = Date('Y-m-d');
      $model->save(false);
    }
    return [
        'msg' => 'ย้านข้อมูลสำเร็จ',
        'count' => count($pks)
    ];

    
}
}

<?php

namespace app\modules\chiefcomplaint\controllers;

use Yii;
use app\modules\chiefcomplaint\models\PccServiceCc;
use app\modules\chiefcomplaint\models\PccServiceCcSeach;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use \yii\web\Response;
use yii\helpers\Html;
use yii\helpers\Json;
use yii\filters\AccessControl;
use app\components\PatientHelper;
/**
 * PccserviceccController implements the CRUD actions for Pccservicecc model.
 */
class PccserviceccController extends Controller
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
                ],
            ],
        ];
    }

    /**
     * Lists all Pccservicecc models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new PccserviceccSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Pccservicecc model.
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
     * Creates a new Pccservicecc model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $request = Yii::$app->request;
        $model = new Pccservicecc();
        
        $searchModel = new \app\modules\chiefcomplaint\models\PccServiceCcSearch;
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        //$dataProvider->query->where(['cid' => $cid,'pcc_vn'=>$vn]);
        $dataProvider->query->orderBy('date_service DESC ');
        
        
        $vn= PatientHelper::getCurrentVn();
        $cid =PatientHelper::getCurrentCid();
        $hn =PatientHelper::getCurrentHn();
        
        $model->vn = $vn;
        $model->cid=$cid;
        $model->hn=$hn;
        $model->date_service=date('Y-m-d');
        $model->time_service=date('H:m:s');
        
        if ($request->isAjax) {
            Yii::$app->response->format = Response::FORMAT_JSON;

            if ($model->load(Yii::$app->request->post()) && $model->save()) {
               return ['forceReload'=>'#crud-cc-pjax'];
            }

            return $this->render('create', [
                        'model' => $model,
                        'dataProvider'=>$dataProvider
            ]);
        }

        
        
        
    }

    
    /**
     * Updates an existing Pccservicecc model.
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
     * Deletes an existing Pccservicecc model.
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
     * Finds the Pccservicecc model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $id
     * @return Pccservicecc the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Pccservicecc::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}

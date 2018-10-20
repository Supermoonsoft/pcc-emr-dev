<?php

namespace app\modules\doctorworkbench\controllers;

use Yii;
use yii\filters\AccessControl;
use app\modules\doctorworkbench\models\PccDiagnosis;
use app\modules\doctorworkbench\models\PccDiagnosisSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use \yii\web\Response;
use yii\helpers\Html;
use yii\helpers\Json;
use app\components\PatientHelper;
use app\modules\doctorworkbench\models\CDiagtext;
use app\modules\doctorworkbench\models\CIcd10tm;
use app\components\VisitController;

/**
 * PccDiagnosisController implements the CRUD actions for PccDiagnosis model.
 */
class PccDiagnosisController extends VisitController
{

    
    public function behaviors()
    {
        return [
//            'access' => [
//                'class' => AccessControl::className(),
//               'only' => ['index','create','delete','bulk-delete','icd10-list'],
//                'rules' => [
//                    [
//                        'actions' => ['index','create','delete','bulk-delete','icd10-list'],
//                        'allow' => true,
//                        'roles' => ['@'],
//                    ],
//                ],
//            ],

        ];
    }
    
    public function actionIndex()
    {    
        $id = Yii::$app->request->get('id');
        $cid = PatientHelper::getCurrentCid();
        $pcc_vn = PatientHelper::getCurrentVn();
        $searchModel = new PccDiagnosisSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $dataProvider->query->where(['cid' => $cid]);
        $dataProvider->query->orderBy('date_service ASC');
        if($id){
            $model =  PccDiagnosis::find()->where(['id' => $id])->one(); 

        }else{
            $model = new PccDiagnosis(); 
        }
        $model->cid = $cid;
        $model->pcc_vn = $pcc_vn;
        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'model' => $model,
            'id' => $id
            
        ]);
    }

    public function actionCreate()
    {
        $request = Yii::$app->request;
        $model = new PccDiagnosis();  
        Yii::$app->response->format = Response::FORMAT_JSON;
        if ($model->load($request->post())) {
            if($model->icd_code){
            $model->icd_name = CIcd10tm::find()->where(['diagcode' => $model->icd_code])->one()->diagename;
            }else{
                $model->icd_code = NULL;
            }
            //$model->diag_type = 2;
            // if ($model->diag_text == "") {
            //     $model->diag_text = NULL;
            //   }else {$model->diag_text = json_encode($model->diag_text);}
            //   $model->date_service = Date('Y-m-d');
         $model->save(false);
        //  return ['forceReload'=>'#crud-diagnosis-pjax'];
        return $this->redirect(['index']);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    public function actionUpdateAjax()
    {
        Yii::$app->response->format = Response::FORMAT_JSON;
        // $request = Yii::$app->request;
        $post = Yii::$app->request->post('PccDiagnosis');
        if ($post) {
            $model = $this->findModel($post['id']);
            $model->icd_name = CIcd10tm::find()->where(['diagcode' => $post['icd_code']])->one()->diagename;
            if ($post['diag_text'] == "") {
                $model->diag_text = NULL;
              }else {$model->diag_text = json_encode($post['diag_text']);}
        $model->diag_type = $post['diag_type'];
        $model->save(false);
        return ['forceReload'=>'#crud-diagnosis-pjax'];
       
        }
    }

    public function actionUpdate($id)
    {
        Yii::$app->response->format = Response::FORMAT_JSON;
        $request = Yii::$app->request;
        $model = $this->findModel($id);       
            if ($model->load($request->post()) ) {
                 if($model->icd_code){
                $model->icd_name = CIcd10tm::find()->where(['diagcode' => $model->icd_code])->one()->diagename;
                }else{
                    $model->icd_code = NULL;
                }
            $model->save();
               return $this->redirect(['index']);                
            } else {
                return $this->redirect(['index']);
            }
        }

    private function DiagText($cc){

    }

    public function actionDelete($id)
    {
        $request = Yii::$app->request;
        $this->findModel($id)->delete();

        if($request->isAjax){
            /*
            *   Process for ajax request
            */
            Yii::$app->response->format = Response::FORMAT_JSON;
            // return ['forceClose'=>true,'forceReload'=>'#crud-datatable-pjax'];
            return $this->redirect(['index']);            
        }else{
            /*
            *   Process for non-ajax request
            */
            return $this->redirect(['index']);
        }


    }

    public function actionBulkDelete()
    {        
        $request = Yii::$app->request;
        $pks = explode(',', $request->post('pks')); // Array or selected records primary keys
        foreach ( $pks as $pk ) {
            $model = $this->findModel($pk);
            $model->delete();
        }

        if($request->isAjax){
            /*
            *   Process for ajax request
            */
            Yii::$app->response->format = Response::FORMAT_JSON;
            return ['forceClose'=>true,'forceReload'=>'#crud-datatable-pjax'];
        }else{
            /*
            *   Process for non-ajax request
            */
            return $this->redirect(['index']);
        }
       
    }

    protected function findModel($id)
    {
        if (($model = PccDiagnosis::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

public function actionIcd10List($q = null, $id = null){
    Yii::$app->response->format = \yii\web\Response::FORMAT_JSON; //กำหนดการแสดงผลข้อมูลแบบ json
    $out = ['results'=>['diagcode'=>'','text'=>'']];
    if(!is_null($q)){
        $query = new \yii\db\Query();
        $query->select(["diagename","diagtname","diagcode as id", "concat('(',diagcode,')',' - ',diagename,' - ',diagtname) as text"])
                ->from('c_icd10tm')
                ->where("diagcode LIKE '%".$q."%'")
                ->orWhere("diagename LIKE '%".$q."%'")
                ->orWhere("diagtname LIKE '%".$q."%'")
                ->limit(20);
        $command = $query->createCommand();
        $data = $command->queryAll();
        $out['results'] = array_values($data);
    }else if($id>0){
        $out['results'] = ['diagcode'=>$id, 'text'=>  CIcd10tm::find($id)->diagcode];
    }
    return $out;
}


public function actionEditable(){
    if (Yii::$app->request->post('hasEditable')){
        \Yii::$app->response->format = Response::FORMAT_JSON;
        $id = Yii::$app->request->post('editableKey');
        $data = PccDiagnosis::findOne($id);
        $posted = current($_POST['PccDiagnosis']);
        $post['PccDiagnosis'] = $posted;
        if ($data->load($post)) {
            $data->save();
            //$value = $_POST['TbDataDetail']; // มีมากกว่า1ฟิว
            $value = $data->diag_type;
          return ['output'=>$value, 'message'=>''];
          //$output = $posted;
           // return ['forceReload' => '#crud-datatable'];
        }
      }
}

public function actionGetDiag(){
    $request = Yii::$app->request;
    Yii::$app->response->format = Response::FORMAT_JSON;
    $model = $this->findModel($request->post('id'));
    return $model;
}

}

<?php

namespace app\modules\doctorworkbench\controllers;

use yii;
use yii\helpers\Json;
use app\modules\doctorworkbench\models\CIcd10tm;
use app\modules\doctorworkbench\models\PccDiagnosis;
use app\modules\doctorworkbench\models\PccDiagnosisSearch;
use app\modules\lab\models\Hoslab;
use app\modules\lab\models\HoslabSearch;
use app\modules\drug\models\Hosdrug;
use app\modules\drug\models\HosdrugSearch;


class OrderController extends \yii\web\Controller
{
    public function actionIndex()
    {
        $modelPccDiagnosis = new PccDiagnosis();
        $searchModelPccDiagnosis = new PccDiagnosisSearch();
        $dataProviderPccDiagnosis = $searchModelPccDiagnosis->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'modelPccDiagnosis' => $modelPccDiagnosis,
            'searchModelPccDiagnosis' => $searchModelPccDiagnosis,
            'dataProviderPccDiagnosis' => $dataProviderPccDiagnosis,
        ]);
    }

    public function actionProcedure(){
        return $this->render('procedure');
    }
    
    public function actionAppointment(){
        return $this->render('appointment');

    }
    public function actionEmr(){
        return $this->render('emr');

    }
    public function actionPreOrderLab(){
        return $this->render('pre_order_lab');

    }
    public function actionDrug(){
        $searchModel_drug = new HosdrugSearch();
        $dataProvider_drug = $searchModel_drug->search(Yii::$app->request->queryParams);
        return $this->render('drug',[
            'searchModel_drug' => $searchModel_drug,
            'dataProvider_drug' => $dataProvider_drug,
        ]);

    }

    public function actionLab($cid=NULL)
    {
        $searchModel = new HoslabSearch($cid);
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        return $this->render('lab',[
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'cid'=>$cid
        ]);
    }
        

    public function actionTreatmmentPlan(){
        return $this->render('treatmment_plan');
    }

        public function actionIcd10List($q = null, $id = null){
            Yii::$app->response->format = \yii\web\Response::FORMAT_JSON; //กำหนดการแสดงผลข้อมูลแบบ json
            $out = ['results'=>['diagcode'=>'','text'=>'']];
            if(!is_null($q)){
                $query = new \yii\db\Query();
                $query->select('diagcode as id, diagcode as text')
                        ->from('c_icd10tm')
                        ->where("diagcode LIKE '%".$q."%'")
                        ->limit(20);
                $command = $query->createCommand();
                $data = $command->queryAll();
                $out['results'] = array_values($data);
            }else if($id>0){
                $out['results'] = ['diagcode'=>$id, 'text'=>  CIcd10tm::find($id)->diagcode];
            }
            return $out;
        }


        public function actionDiagnosisSave(){
            Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
            $post = Yii::$app->request->post();
            $model = new PccDiagnosis();
            $model->hn = 000001;
            $model->vn = 88888888;
            $model->icd_code = "A00";
            $model->diag_type = 1;
            $model->save(false);
        }

        public function actionTabsData($tab=null) {
            $html = $this->renderPartial('index');
            return Json::encode($html);
        }

        public function actionSelectTemplate(){
            return $this->render('select2_template');
        }



}

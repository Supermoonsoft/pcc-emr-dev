<?php

namespace app\modules\doctorworkbench\controllers;

use yii;
use app\modules\doctorworkbench\models\CIcd10tm;
use app\modules\doctorworkbench\models\PccDiagnosis;
use app\modules\doctorworkbench\models\PccDiagnosisSearch;


class OrderController extends \yii\web\Controller
{
    // public function actionIndex()
    // {
    //     $model = new SDoctordiag();

    //     $models = new SDoctordiag();
    //     $request = Yii::$app->getRequest();
    //     if ($request->isPost && $request->post('ajax') !== null) {
    //         $data = Yii::$app->request->post('Item', []);
    //         foreach (array_keys($data) as $index) {
    //             $models[$index] = new SDoctordiag();
    //         }
    //         Model::loadMultiple($models, Yii::$app->request->post());
    //         Yii::$app->response->format = Response::FORMAT_JSON;
    //         $result = ActiveForm::validateMultiple($models);
    //         return $result;
    //     }
    //     return $this->render('index',[
    //         'model' => $models
    //     ]);
    //     }


    // public function actionIndex()
    // {
    //     $model = new SDoctordiag(); //สร้างใบ Order
    //     if($model->load(Yii::$app->request->post()))
    //     {
            
    //         $transaction = Yii::$app->db->beginTransaction();
            
    //         try {
    //             $model->save(); //บันทึกใบ Order

    //             $items = Yii::$app->request->post();
                
    //             //var_dump($items['Order']['items']);
                
    //             foreach($items['s_doctordiag']['items'] as $key => $val){ //นำรายการสินค้าที่เลือกมา loop บันทึก
    //                 if(empty($val['id'])){
    //                     $order_detail = new SDoctordiag();
    //                 }else{
    //                     $order_detail = SDoctordiag::findOne($val['id']);
    //                 }
    //                 $order_detail->order_id = $model->id;
    //                 $order_detail->amount = $val['amount'];
    //                 //หาราคาสินค้า
    //                 $product = Product::findOne($val['product_id']);
                    
    //                 $order_detail->hn = 11111;
    //                 $order_detail->vn = 222222; //ราคาจากสินค้า
    //                 $order_detail->save();
                    
    //             }

    //             $transaction->commit();
    //             Yii::$app->session->setFlash('success', 'บันทึกข้อมูลเรียบร้อย');
    //             return $this->redirect(['index']);
    //         } catch (Exception $e) {
    //             $transaction->rollBack();
    //             Yii::$app->session->setFlash('error', 'มีข้อผิดพลาดในการบันทึก');
    //             return $this->redirect(['index']);
    //         }
    //     }
    //     return $this->render('create', [
    //         'model' => $model,
    //     ]);
    // }

    public function actionIndex()
    {
        $searchModelPccDiagnosis = new PccDiagnosisSearch();
        $dataProviderPccDiagnosis = $searchModelPccDiagnosis->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModelPccDiagnosis' => $searchModelPccDiagnosis,
            'dataProviderPccDiagnosis' => $dataProviderPccDiagnosis,
        ]);
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
}

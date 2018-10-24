<?php

namespace app\modules\queuemanage\controllers;

use yii;
use yii\web\Controller;
use app\components\DbHelper;
use yii\data\SqlDataProvider;
use yii\data\ActiveDataProvider;
use yii\helpers\Json;
use yii\data\Pagination;
use yii\db\Query;
use app\modules\queuemanage\models\PccDoctorRoomQueue;
use app\modules\queuemanage\models\PccVisit;
use app\modules\queuemanage\models\PccVisitSearch;


/**
 * Default controller for the `queuemanage` module
 */
class DefaultController extends Controller {

    /**
     * Renders the index view for the module
     * @return string
     */
    public function actionIndex() {
       
        $vn = [];
        $sql_update ='';
        if(Yii::$app->request->post('param')){
            $param = 1;
        }else{
            $param = 0;
        }
        
        $date1 = date('Y-m-d');
        $date2 = date('Y-m-d');
        // $date1 = date('2018-08-01');
        // $date2 = date('2018-10-20');
        // $sql = "SELECT t.pcc_vn,p.hn,p.cid,t.visit_date_begin,t.visit_time_begin 
        // ,concat(p.prename,p.fname,' ',p.lname) fullname
        // from pcc_visit t 
        // LEFT JOIN gateway_emr_patient  p ON p.cid = t.person_cid
        // WHERE t.visit_date_begin BETWEEN '$date1' AND '$date2'
        // AND t.current_station = 'A0' order by t.visit_date_begin asc,t.visit_time_begin asc";
        // $raw = DbHelper::queryAll('db', $sql);

        // $sqlcount = "SELECT count(*) from pcc_visit t 
        // LEFT JOIN gateway_emr_patient  p ON p.cid = t.person_cid
        // WHERE t.visit_date_begin BETWEEN '$date1' AND '$date2'
        // AND t.current_station = 'A0'";
        // $count = DbHelper::queryScalar('db', $sqlcount);

         #################################
         $query = new Query;
        // compose the query
        $query->select(["t.jhcis_vn","t.pcc_vn as pcc_vn","p.hn","p.cid","t.visit_date_begin","t.visit_time_begin","concat(p.prename,p.fname,' ',p.lname) fullname"]);
        $query->distinct();
        $query->leftJoin("gateway_c_patient  p","p.cid = t.person_cid");
        $query->where("t.visit_date_begin BETWEEN :date1 AND :date2 AND t.current_station = 'A0'");
        // $query->where("t.current_station = 'A0'");
        $query->from('pcc_visit t');
        $query->addParams([':date1' => $date1,':date2' => $date2]);
        // $query->groupBy("t.pcc_vn");
        $query->orderBy([
            't.jhcis_vn' => SORT_ASC,
            't.visit_date_begin' => SORT_ASC,
            't.visit_time_begin' => SORT_ASC
            ]);
        $command = $query->createCommand();
        $rows = $command->queryAll();
        $count = $query->count();
        $pages = new Pagination(['totalCount' => $count]);
        $query->offset($pages->offset);
        $query->limit(10);
        $rows = $query->all();
        return $this->render('index', [
                    'data' => $sql_update,
                    'param' => $param,
                    // 'models' => $models,
                    'pages' => $pages,
                    'rows' => $rows
 
        ]);
    }

public function actionSave(){
    if (\Yii::$app->request->isPost) {
        $pt = \Yii::$app->request->post('pt');
        foreach ($pt as $p) {
            $vn[] = "'" . $p . "'";
        }
        $vn = implode(',', $vn);
        $sql_update = "update pcc_visit SET current_station = 'A1' WHERE pcc_vn IN  ($vn) ";
        DbHelper::execute('db', $sql_update);

        $num =  Yii::$app->request->post('num');
        $room =  Yii::$app->request->post('room');
        $sendtime =  Yii::$app->request->post('sendtime');
        $cid =  Yii::$app->request->post('cid');
        $i = 0;
        foreach ($pt as $p):
            $model = new PccDoctorRoomQueue();
            $n = $i++;
            $model->order_number = $num[$n];
            $model->pcc_vn = $p;
            $model->room_id = $room;
            $model->nurse_send_date = Date('Y-m-d');
            $model->nurse_send_time = $sendtime[$n];
            $model->cid = $cid[$n];
            $model->save();
        endforeach;

        return $this->redirect(['/queuemanage']);
    }else{
        return $this->redirect(['/queuemanage']);

}


}


public function actionViewAll(){
    // \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;

    $searchModel = new PccVisitSearch();
    $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

    if($searchModel->date1){
        $date1 = $searchModel->date1;
        $date2 = $searchModel->date2;
    }else{
    $date1 = date('Y-m-d');
    $date2 = date('Y-m-d');
    }

    if($searchModel->visit_department){
        foreach($searchModel->visit_department as $d){
            $dep_id[] = "'" . $d . "'";
                }
            $dep = implode(',', $dep_id);
            $department = 'AND t.visit_department IN('.$dep.')';
        
    }else{
        $department = "";
    }
    
    $sql = "SELECT t.pcc_vn,p.hn,p.cid,t.visit_date_begin,t.visit_time_begin 
    ,concat(p.prename,p.fname,' ',p.lname) fullname,AGE(p.birthday) as age,t.visit_department
    from pcc_visit t 
    LEFT JOIN gateway_emr_patient  p ON p.cid = t.person_cid
    WHERE t.visit_date_begin BETWEEN '$date1' AND '$date2'
    $department order by t.visit_date_begin asc,t.visit_time_begin asc";
    $raw = DbHelper::queryAll('db', $sql);

    $sql_count = "SELECT count(*) from pcc_visit t 
    LEFT JOIN gateway_emr_patient  p ON p.cid = t.person_cid
    WHERE t.visit_date_begin BETWEEN '$date1' AND '$date2'";
    $count = DbHelper::queryScalar('db', $sql_count);


    $dataProvider = new SqlDataProvider([
    'sql' => $sql,
    // 'params' => [':status' => 1],
    'totalCount' => $count,
    'pagination' => [
        'pageSize' => 10,
    ],
    'sort' => [
        'attributes' => [
            'title',
            'view_count',
            'created_at',
        ],
    ],
]);

    return $this->render('view_all', [
              'dataProvider' => $dataProvider,
              'searchModel' => $searchModel,
              'count' => $count
    ]);
}
}

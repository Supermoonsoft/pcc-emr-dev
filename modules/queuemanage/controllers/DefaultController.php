<?php

namespace app\modules\queuemanage\controllers;

use yii\web\Controller;
use app\components\DbHelper;
use yii\data\SqlDataProvider;

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
        if (\Yii::$app->request->isPost) {
            $pt = \Yii::$app->request->post('pt');
            foreach ($pt as $p) {
                $vn[] = "'" . $p . "'";
            }
            $vn = implode(',', $vn);
            $sql_update = "update pcc_visit SET current_station = 'A1' WHERE pcc_vn IN  ($vn) ";
            DbHelper::execute('db', $sql_update);
        }
        $date1 = date('Y-m-d');
        $date2 = date('Y-m-d');
        $sql = "SELECT t.pcc_vn,p.hn,p.cid,t.visit_date_begin,t.visit_time_begin 
,concat(p.prename,p.fname,' ',p.lname) fullname
from pcc_visit t 
LEFT JOIN gateway_emr_patient  p ON p.cid = t.person_cid
WHERE t.visit_date_begin BETWEEN '$date1' AND '$date2'
AND t.current_station = 'A0' order by t.visit_date_begin asc,t.visit_time_begin asc";
        $raw = DbHelper::queryAll('db', $sql);



            // $count = Yii::$app->db->createCommand('
            // SELECT COUNT(*) FROM post WHERE status=:status
            // ', [':status' => 1])->queryScalar();

            $dataProvider = new SqlDataProvider([
            'sql' => $sql,
            // 'params' => [':status' => 1],
            // 'totalCount' => $count,
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

// returns an array of data rows
// $models = $provider->getModels();

        return $this->render('index', [
                    'raw' => $raw,
                    'data' => $sql_update,
                    'dataProvider' => $dataProvider
        ]);
    }

}

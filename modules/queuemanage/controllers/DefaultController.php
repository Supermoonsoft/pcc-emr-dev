<?php

namespace app\modules\queuemanage\controllers;

use yii\web\Controller;
use app\components\DbHelper;

/**
 * Default controller for the `queuemanage` module
 */
class DefaultController extends Controller
{
    /**
     * Renders the index view for the module
     * @return string
     */
    public function actionIndex()
    {
        $sql = "SELECT t.pcc_vn,p.hn,t.visit_date_begin,t.visit_time_begin 
,concat(p.prename,p.fname,' ',p.lname) fullname
from pcc_visit t 
LEFT JOIN pcc_patient  p ON p.cid = t.person_cid
WHERE t.visit_date_begin BETWEEN '2018-09-22' AND '2018-09-22'
AND t.current_station = 'A0' order by t.visit_date_begin asc,t.visit_time_begin asc";
        
        $raw = DbHelper::queryAll('db', $sql);
        return $this->render('index',[
            'raw'=>$raw
        ]);
    }
}

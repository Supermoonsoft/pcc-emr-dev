<?php

namespace app\components;

use yii\base\Component;
use app\components\DbHelper;

class PatientHelper extends Component {

    public static function getCurrentPatientTitle() {
        $vn = self::getCurrentVn();
        $sql = " SELECT p.hn,concat(p.prename,p.fname,' ',p.lname) fullname
from pcc_visit t 
LEFT JOIN gateway_emr_patient  p ON p.cid = t.person_cid
WHERE t.pcc_vn = '$vn'";
        $pt = DbHelper::queryOne('db', $sql);

        return "(".$pt['hn'].")".$pt['fullname'];
    }

    public static function getCurrentCid() {
        $vn = self::getCurrentVn();
        $sql = " SELECT t.person_cid from pcc_visit t 
WHERE t.pcc_vn = '$vn' limit 1";
        $cid = DbHelper::queryScalar('db', $sql);

        return $cid;
    }

    public static function genNextHn() {
        
    }

    public static function setCurrentHn($hn) {
        self::removeCurrentHn();
        \Yii::$app->session->set('hn', $hn);
    }

    public static function setCurrentVn($vn) {
        self::removeCurrentVn();
        \Yii::$app->session->set('vn', $vn);
    }

    public static function setCurrenHnVn($hn, $vn) {
        self::removeCurrentHnVn();
        \Yii::$app->session->set('hn', $hn);
        \Yii::$app->session->set('vn', $vn);
    }

    public static function getCurrentHn() {
        return \Yii::$app->session->get('hn');
    }

    public static function getCurrentVn() {
        return \Yii::$app->session->get('vn');
    }

    public static function removeCurrentHn() {
        \Yii::$app->session->remove('hn');
    }

    public static function removeCurrentVn() {
        \Yii::$app->session->remove('vn');
    }

    public static function removeCurrentHnVn() {
        \Yii::$app->session->remove('hn');
        \Yii::$app->session->remove('vn');
    }
    public static function removeCurrentPatient(){
        \Yii::$app->session->remove('hn');
        \Yii::$app->session->remove('vn');
        \Yii::$app->session->remove('cid');
        
    }
    public static function openVisit($cid){
        $date  = date('Y-m-d');
        $time = date('H:i:s');
        $sql = "insert into pcc_visit (person_cid,visit_date_begin,visit_time_begin,current_station) values ('$cid','$date','$time','A1')";
        DbHelper::execute('db', $sql);

        $sql = "select pcc_vn from pcc_visit where person_cid = '$cid' order by pcc_vn DESC limit 1";
        $pcc_vn = DbHelper::queryScalar('db', $sql);       
        return $pcc_vn;
        
    }

}

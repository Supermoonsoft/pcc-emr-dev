<?php

namespace app\components;

use app\components\PatientHelper;

class VisitController extends \yii\web\Controller {

    public function beforeAction($action) {
        $cid = PatientHelper::getCurrentCid();
        $pcc_vn = PatientHelper::getCurrentVn();
        if (empty($cid)) {
            return $this->redirect(['/queuemanage']);
        }
        if(empty($pcc_vn)){
            return $this->redirect(['/queuemanage']);
        }
        return parent::beforeAction($action);
    }

}

<?php

//เพิ่ม module ที่นี่ที่เดียว
$modules = [];

$modules['gridview'] = ['class' => '\kartik\grid\Module']; //system 

$modules['lab'] = ['class' => 'app\modules\lab\Lab']; //pond 
$modules['drug'] = ['class' => 'app\modules\drug\Drug']; //pond 
$modules['doctorworkbench'] = ['class' => 'app\modules\doctorworkbench\Doctorworkbench']; //oh
$modules['queuemanage'] = ['class' => 'app\modules\queuemanage\QueueManage']; //tehnn
$modules['emr'] = ['class' => 'app\modules\emr\Emr']; //jub
$modules['printout'] = ['class' => 'app\modules\printout\PrintOut'];
$modules['report'] = ['class' => 'app\modules\report\Report'];
$modules['stock'] = ['class' => 'app\modules\stock\Stock'];
$modules['setsession'] = ['class' => 'app\modules\setsession\SetSession']; //tehnn
$modules['patientexit'] = ['class' => 'app\modules\patientexit\PatientExit']; //tehnn
$modules['user'] = [
    'class' => 'dektrium\user\Module',
    'enableUnconfirmedLogin' => true,
    'confirmWithin' => 21600,
    'cost' => 12,
    'admins' => ['admin']]; // inam
$modules['rbac'] = ['class' => 'dektrium\rbac\RbacWebModule']; //inam
$modules['chiefcomplaint'] = ['class' => 'app\modules\chiefcomplaint\Chiefcomplaint'];//pond 
$modules['treatment'] = ['class' => 'app\modules\treatment\Treatment'];//pond
$modules['appointment'] = ['class' => 'app\modules\appointment\Appointment'];//pond

return $modules;


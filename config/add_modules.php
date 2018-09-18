<?php

//เพิ่ม module ที่นี่ที่เดียว
$modules = [];

$modules['gridview'] =  ['class' => '\kartik\grid\Module'];//system 

$modules['lab'] =  ['class' => 'app\modules\lab\Lab'];//pond 
$modules['drug'] =  ['class' => 'app\modules\drug\Drug'];//pond 
$modules['doctorworkbench'] =  ['class' => 'app\modules\doctorworkbench\Doctorworkbench'];//oh
$modules['queuemanage'] = ['class' => 'app\modules\queuemanage\QueueManage']; //tehnn

return $modules;


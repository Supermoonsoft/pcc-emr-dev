<?=$this->render('../default/panel_top',[
'emr' => '',
'lab' => '',
'drug' => 'active',
'diagnosis' => '',
'medication' => '',
'procedure' => '',
'pre_order_lab' =>'',
'apointment' => '',
'treatmment_plan' => '',
'cc' => '',
'pi' => '',
              'pe' => ''

]);?>
<?php
   echo $this->render('@app/modules/drug/views/pccmed/index',[
    'searchModel' => $searchModel,
    'dataProvider' => $dataProvider,
]);
?>
<?=$this->render('../default/panel_foot');?>

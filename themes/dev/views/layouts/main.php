<?php
/* @var $this \yii\web\View */
/* @var $content string */

//
use yii\helpers\Html;
use yii\widgets\Breadcrumbs;
use app\assets\DevAsset;
use yii\widgets\ActiveForm;
use yii\helpers\Url;
use app\components\PatientHelper;
use app\components\loading\ShowLoading;
use app\components\DbHelper;
use yii\bootstrap\Modal;
use app\modules\queuemanage\models\GatewayEmrAllergy;


$sql_q = "SELECT t.pcc_vn,p.hn,t.visit_date_begin,t.visit_time_begin 
,concat(p.prename,p.fname,' ',p.lname) fullname
from pcc_visit t 
INNER JOIN gateway_c_patient  p ON p.cid = t.person_cid
WHERE t.current_station = 'A1' order by t.visit_date_begin asc,t.visit_time_begin asc ";
$pt_q = DbHelper::queryAll('db', $sql_q);
$pt_count = count($pt_q);

DevAsset::register($this);
\yii\bootstrap\BootstrapAsset::register($this);

$cid = PatientHelper::getCurrentCid();
$allergy = GatewayEmrAllergy::find();
$count = $allergy->where(['cid' => $cid])->count();

?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
    <head>
        <meta charset="<?= Yii::$app->charset ?>">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="icon" href="./img/medico.ico" type="image/x-icon"/>
        <link rel="shortcut icon" href="./img/medico.ico" type="image/x-icon"/>

        <style>
            #user-display > a:link {
                color: white;
            }

            /* visited link */
            #user-display > a:visited {
                color: white;
            }

            /* mouse over link */
            #user-display > a:hover {
                color: whitesmoke;
            }

            /* selected link */
            #user-display > a:active {
                color: whitesmoke;
            }

            .breadcrumb > li + li:before {
                content: "|" !important;
            }
        </style>
        <?= Html::csrfMetaTags() ?>
        <title>Medico PCC EMR</title>
        <?php $this->head() ?>
    </head>
    <body>

        <?php $this->beginBody() ?>
        <?= ShowLoading::widget() ?>

        <nav class="navbar navbar-inverse navbar-fixed-top">
            <div class="container-fluid">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <a class="navbar-brand" href="<?= Url::to(['/site/index']) ?>"><img src="img\brand.png" height="30px" /></a>

                </div>
                <div id="navbar" class="collapse navbar-collapse">
                    <ul class="nav navbar-nav">
                        <li>
                            <div style="padding-top: 10px">
                                <?php
                                $form = ActiveForm::begin([
                                            'method' => 'POST',
                                            'action' => Url::to(['/site/patient-search']),
                                            'options' => ['class' => 'form-inline']
                                ]);
                                ?>
                                <div class="form-group">
                                    <input type="text" name="cid" id="cid_search" class="form-control" maxlength="13" placeholder="HN/CID/NAME">
                                </div>
                                <button type="submit" class="btn btn-default"><i class="glyphicon glyphicon-search"></i></button>

                                <?php ActiveForm::end() ?>
                            </div>
                        </li>
                        <li>
                            <div style="padding-top: 8px;padding-left: 50px;color: white;">
                                <h4>
                                    <?php $pcc_vn = PatientHelper::getCurrentVn(); ?>
                                    <?php if (!empty($pcc_vn)): ?>
                                        <i class="fa fa-wheelchair"></i>
                                        <?= PatientHelper::getCurrentPatientTitle() ?> 
                                       
                                        <a style="color: white" href="#" data-value="<?= Url::to(['/patientexit', 'pcc_vn' => $pcc_vn]) ?>" id='btn-patient-exit'><i class="fa fa-times" aria-hidden="true"></i></a>
                                    <?php endif; ?>
                                </h4>
                            </div>
                        </li>

                    </ul>
                    <ul class="nav navbar-nav navbar-right" style="padding-right: 20px;">
                        <li><a data-toggle="modal" data-target="#myModal"><i class="fa fa-bell"  style="font-size:20px;color:white"></i>
                       
                        <?php if($count > 0):?>
                        <span class="badge badge-light"><?=$count;?></span>
                                <?php endif;?>
                        </a></li>

                        <li style="padding-right: 30px;"><a data-toggle="modal" data-target="#myModal2"><i class="fa fa-user"  style="font-size:20px;color:white;"></i><span class="badge badge-light"><?= $pt_count ?></span></a></li>

                        <li><img src="img\profile.png" height="40px" class="img-circle" style="padding-top: 6px;" /></li>
                        <li  style="padding-top: 5px;padding-left: 5px;">
                            <h4>
                                <div id='user-display'>
                                    <?php if (\Yii::$app->user->isGuest): ?>

                                        <?= Html::a('Login', ['/user/security/login']) ?>
                                    <?php else: ?>
                                        <li class="">
                                            <a href="javascript:;" class="user-profile dropdown-toggle" data-toggle="dropdown" aria-expanded="false" style="color: white">                                            
                                                <?php echo Yii::$app->user->identity->username . ':' . Yii::$app->user->identity->name; ?>
                                                <span class=" fa fa-angle-down"></span>
                                            </a>
                                            <ul class="dropdown-menu dropdown-usermenu pull-right">

                                                <li>
                                                    <?php echo Html::a('ข้อมูลส่วนตัว <i class="fa fa-user pull-right"></i>', yii\helpers\Url::to(['/users/indexuser']), ['data-method' => 'post']) ?>
                                                </li>
                                                <li>
                                                    <?php echo Html::a('ออกจากระบบ <i class="fa fa-sign-out pull-right"></i>', yii\helpers\Url::to(['/site/logout']), ['data-method' => 'post']) ?>
                                                </li>
                                            </ul>
                                        </li>

                                    <?php endif; ?>
                                </div>
                            </h4>
                        </li>
                    </ul>
                </div><!--/.nav-collapse -->

            </div>
        </nav>
        <?php
        //\Yii::$app->user->can($permissionName);
        ?>
        <?php if (1 == 1): //nurse ?>
            <?= $this->render('@app/components/_toolbar_nurse') ?>
        <?php else: ?>
            <?= $this->render('@app/components/_toolbar_doctor') ?>
        <?php endif; ?>


        <div  style="width: 99%; padding-top: 10px;margin: 0 auto;">

            <?=
            Breadcrumbs::widget([
                'homeLink' => FALSE,
                'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
            ])
            ?>

            <?php echo \yii2mod\notify\BootstrapNotify::widget(); ?>
            <?= $content ?>
        </div><!-- /.container -->

        <!-- Modal -->
        <div class="modal right fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
            <div class="modal-dialog" role="document">
                <div class="modal-content">

                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title" id="myModalLabel">เตือน</h4>
                    </div>

                    <div class="modal-body">
                        <!-- <h3><i class="fa fa-exclamation"></i> แพ้ยา Penicillin</h3> -->
<!-- แพ้ยา -->
                    <style>
                    ul.timeline {
                        list-style-type: none;
                        position: relative;
                    }
                    ul.timeline:before {
                        content: ' ';
                        background: #d4d9df;
                        display: inline-block;
                        position: absolute;
                        left: 29px;
                        width: 2px;
                        height: 100%;
                        z-index: 400;
                    }
                    ul.timeline > li {
                        margin: 20px 0;
                        padding-left: 20px;
                    }
                    ul.timeline > li:before {
                        content: ' ';
                        background: white;
                        display: inline-block;
                        position: absolute;
                        border-radius: 50%;
                        border: 3px solid #22c0e8;
                        left: 20px;
                        width: 20px;
                        height: 20px;
                        z-index: 400;
                    }

                    .label-pink,
                    .badge-pink { background-color: #d6487e!important }
                    .label-primary.arrowed:before { border-right-color: #2283c5 }
                    .label-primary.arrowed-in:before { border-color: #2283c5 }
                    .label-primary.arrowed-right:after { border-left-color: #2283c5 }
                    .label-primary.arrowed-in-right:after { border-color: #2283c5 }
                    .label-pink.arrowed:before { border-right-color: #d6487e }
                    .label-pink.arrowed-in:before { border-color: #d6487e }
                    .label-pink.arrowed-right:after { border-left-color: #d6487e }
                    .label-pink.arrowed-in-right:after { border-color: #d6487e }
                    </style>
                <div class="row">
                        <div class="col-md-12">
                            <h4><i class="fa fa-exclamation"></i> แพ้ยา Penicillin</h4>
                            <ul class="timeline">
                            <?php $i = 1; foreach($allergy->where(['cid' => $cid])->all() as $allergy):?>
                                <li>
                                    <a target="_blank" href="https://www.totoprayogo.com/#"><?=$allergy->drug_name;?></a>
                                    <p>	<span class="label label-large label-pink arrowed-right">ระดับ</span> : <?=$allergy->level;?></p>
                                    <p><span class="label label-large label-primary arrowed-right">อาการ</span> : <?=$allergy->symptom;?></p>
                                </li>
                                <hr>
                                <?php endforeach;?>
                            </ul>
                        </div>
                    </div>

                        <!-- <h3><i class="fa fa-exclamation"></i> วัคซีน -</h3> -->
                    </div>
<!-- จบแพ้ยา -->
                </div><!-- modal-content -->
            </div><!-- modal-dialog -->
        </div><!-- modal -->

        <!-- Modal -->
        <div class="modal right fade" id="myModal2" tabindex="-1" role="dialog" aria-labelledby="myModalLabel2">
            <div class="modal-dialog" role="document">
                <div class="modal-content">

                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title" id="myModalLabel2">รอตรวจ</h4>
                    </div>

                    <div class="modal-body">
                        <?php foreach ($pt_q as $key => $value): ?>
                            <?php if(!empty($cid)):  ?>
                            <h4><a href="<?= Url::to(['/setsession', 'pcc_vn' => $value['pcc_vn']]) ?>" data-confirm="แทนที่คนปัจุบัน" ><?= $value['fullname'] ?></a></h4>
                            <?php else: ?>
                            <h4><a href="<?= Url::to(['/setsession', 'pcc_vn' => $value['pcc_vn']]) ?>"  ><?= $value['fullname'] ?></a></h4>
                            <?php endif; ?>
                        <?php endforeach; ?>


                    </div>

                </div><!-- modal-content -->
            </div><!-- modal-dialog -->
        </div><!-- modal -->

        <?php
        Modal::begin([
            'id' => 'modal-patient-exit',
            'size' => 'modal-sm',
        ]);
        ?>
        <div id="modal-patient-exit-content"></div>
        <?php
        Modal::end();
        ?>



        <?php $this->endBody() ?>
    </body>
</html>
<?php $this->endPage() ?>

<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\modules\doctorworkbench\models\SDoctordiag */

$this->title = 'Create Sdoctordiag';
$this->params['breadcrumbs'][] = ['label' => 'Sdoctordiags', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="sdoctordiag-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>

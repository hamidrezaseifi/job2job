<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\lib\CandidatejobapplyBase */

$this->title = Yii::t('app', 'Update {modelClass}: ', [
    'modelClass' => 'Candidatejobapply Base',
]) . $model->userid;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Candidatejobapply Bases'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->userid, 'url' => ['view', 'userid' => $model->userid, 'jobposid' => $model->jobposid]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="candidatejobapply-base-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>

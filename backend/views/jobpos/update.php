<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\lib\JobPositionBase */

$this->title = Yii::t('app', 'Stellenanzeige bearbeiten');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Stellenanzeige'), 'url' => ['index']];
$this->params['breadcrumbs'][] = Yii::t('app', 'Bearbeiten');
?>
<div class="job-position-base-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        				'model' 				=> $model,
    					'jobypes' 				=> $jobypes,
    					'countries' 			=> $countries,
    					'cities'				=> $cities,
    					'vacancies'				=> $vacancies,
    					'worktypes'				=> $worktypes,
    ]) ?>

</div>

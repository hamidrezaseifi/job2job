<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\lib\JobPositionBase */
/* @var $countries array */
/* @var $vacancies array */
/* @var $worktypes array */
/* @var $branchs array */
/* @var $job2jobComp common\lib\CompanyBase */
/* @var $skills array */
/* @var $companies array */

$this->title = Yii::t('app', 'Neue Stellenanzeige erstellen');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Stellenanzeige'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="job-position-base-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
		'model' 				=> $model,
        'branchs' 				=> $branchs,
		'countries' 			=> $countries,
		'vacancies'				=> $vacancies,
		'worktypes'				=> $worktypes,
        'job2jobComp'			=> $job2jobComp,
        'skills' 				=> $skills,
        'companies' 			=> $companies,
    ]) ?>

</div>

<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\lib\CompanyBase */
/* @var $companytypeList array */
/* @var $employeecountList array */
/* @var $logoModel common\lib\UploadedfilesBase */

$this->title = Yii::t('app', 'Unternehmer bearbeiten');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Unternehmer'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $model->companyname;
?>
<div class="company-base-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' 				=> $model,
    	'companytypeList'		=> $companytypeList,
    	'employeecountList'		=> $employeecountList,
    	'personalEntscheider'	=> $personalEntscheider,
    	'stellVertreter'		=> $stellVertreter,
    	'connectedCompanies'	=> $connectedCompanies,
    	'logopath'				=> $logopath,
    	'logoModel'				=> $logoModel,
    ]) ?>

</div>

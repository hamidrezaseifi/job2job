<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\lib\CompanyBase */
/* @var $companytypeList array */
/* @var $employeecountList array */
/* @var $logoModel common\lib\UploadedfilesBase */
/* @var $personalEntscheiderModel common\lib\PersonaldecisionmakerBase */
/* @var $stellVertreterModel common\lib\PersonaldecisionmakerBase */
/* @var $personalEntscheiderUserModel common\lib\UsersBase */
/* @var $stellVertreterUserModel common\lib\UsersBase */
/* @var $connectedCompanies array */
/* @var $logopath string */
/* @var $titleList array */
/* @var $title2List array */
/* @var $reachabiltyList array */

$this->title = Yii::t('app', 'Neuen Unternehmer erstellen');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Unternehmer'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;

?>
<div class="company-base-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' 				      => $model,
    	'companytypeList'		      => $companytypeList,
    	'employeecountList'		      => $employeecountList,
        'personalEntscheiderModel'	      => $personalEntscheiderModel,
        'stellVertreterModel'		      => $stellVertreterModel,
        'personalEntscheiderUserModel'	  => $personalEntscheiderUserModel,
        'stellVertreterUserModel'		  => $stellVertreterUserModel,
        'connectedCompanies'	      => $connectedCompanies,
    	'logopath'				      => $logopath,
    	'logoModel'				      => $logoModel,
        'titleList' 		=> $titleList,
        'title2List' 		=> $title2List,
        'reachabiltyList' 	=> $reachabiltyList,
        
    ]) ?>

</div>

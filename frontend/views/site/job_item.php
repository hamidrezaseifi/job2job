<?php

//jobpositionDataProvider
/* @var $this yii\web\View */
/* @var $jobpositionModels array */


?>
		
		<a href="<?=Yii::getAlias('@web') ?>/site/jobview?id=$id" ng-repeat="x in itemsList">
		<div class="index-part-2-job_item" data-index="$index"> $jobtitle </div>
		<div class="index-part-2-ort_item"> $country / $city </div>
		</a>

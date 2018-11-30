<?php

/* @var $this yii\web\View */
/* @var $model \common\models\Users */
/* @var $modelSecond \common\models\Users */
/* @var $companyModel \common\models\CompanyBase */
/* @var $pdmModel \common\models\PersonaldecisionmakerBase */
/* @var $pdmModelSecond \common\models\PersonaldecisionmakerBase */
/* @var $searchModel \common\models\PersonaldecisionmakerBase */
/* @var $searchModel \common\models\PersonaldecisionmakerBase */
/* @var $dataProvider \common\models\PersonaldecisionmakerBase */
/* @var $jobadvList array */

use yii\helpers\Html;


$this->registerCssFile("@web/web/css/profileunternehmen.css", [], 'css-profileunternehmen');
$this->registerCssFile("@web/web/css/styleradio.css", [], 'css-style-radio');
$this->registerCssFile("@web/web/css/stylecheckbox.css", [], 'css-style-checkbox');
$this->registerCssFile("@web/web/css/dashboard-applyjob.css", [], 'css-dashboard-applyjob');
$this->registerJsFile("@web/web/js/companyjoblist.js", [], 'js-companyjoblist');
$this->registerJsFile("@web/web/js/appliedadv.js", [], 'js-appliedadv');

$formatter = \Yii::$app->formatter;

?>
<div class="register-bewerbung" ng-controller="AppliedJobController">
    
    <div class="register-bewerbung-title j2jgreenback">
    	<?php echo Yii::t('app', 'Mein beworbene Stellenanzeigen'); ?>
    </div>
     
    <div class="job-adv-list">
    	
		<div ng-if="appliedlist.length == 0"><?php echo Yii::t('app', 'keine beworbene Stellenanzeigen!');?></div>    	
    	<div class="job-adv-list-item" ng-class="{ 'job-adv-list-item-notapp' : item.status != 1 }" ng-repeat="item in appliedlist">
    		<div class="title">{{item.jobtitle}}</div>
    		<div class="delete" title="<?php echo Yii::t('app', 'Löschen'); ?>"><a href="<?=Yii::getAlias('@web') ?>/candidate/dashboard/deleteapplyjobid={{item.id}}" class="delete"></a></div>
    		<div class="edit" title="<?php echo Yii::t('app', 'Ansehen'); ?>"><a href="<?=Yii::getAlias('@web') ?>/site/jobview?id={{item.id}}" target="_blank" ><span class="glyphicon glyphicon-new-window"></span></a></div>
    		<div class="status"><span ng-if="item.status == 1" ><?php echo Yii::t('app', 'in Prozess');?></span><span ng-if="item.status != 1" ><?php echo Yii::t('app', 'nicht gearbeitet');?></span></div>
    		<div class="date">{{item.jobstartdate}}</div>
    		<div class="place">{{item.country}}/{{item.city}}</div>
    	</div>
    	<div class="clear"></div>
    	
    </div>
     
	<div ng-show="loadingshow" class="fade-in-out" style="background-color:rgba(200, 200, 200, 0.5); position: absolute; left:0; top: 0; width: 100%; height: calc(100%);"></div>
    	
    	
     

</div>
<script>
	var markedadvurl = "<?php echo Yii::getAlias('@web/candidate/applyjoblistjson'); ?>";

</script>





<?php

/* @var $this yii\web\View */
/* @var $model \common\models\Users */
/* @var $modelSecond \common\models\Users */
/* @var $companyModel \common\lib\CompanyBase */
/* @var $pdmModel \common\lib\PersonaldecisionmakerBase */
/* @var $pdmModelSecond \common\lib\PersonaldecisionmakerBase */
/* @var $searchModel \common\lib\PersonaldecisionmakerBase */
/* @var $searchModel \common\lib\PersonaldecisionmakerBase */
/* @var $dataProvider \common\lib\PersonaldecisionmakerBase */
/* @var $jobadvList array */

use yii\helpers\Html;


$this->registerCssFile("@web/web/css/profileunternehmen.css", [], 'css-profileunternehmen');
$this->registerCssFile("@web/web/css/styleradio.css", [], 'css-style-radio');
$this->registerCssFile("@web/web/css/stylecheckbox.css", [], 'css-style-checkbox');
$this->registerCssFile("@web/web/css/jobadv.css", [], 'css-jobadv');
$this->registerJsFile("@web/web/js/companyjoblist.js", [], 'js-companyjoblist');
$this->registerJsFile("@web/web/js/markedadv.js", [], 'js-markedadv');

$formatter = \Yii::$app->formatter;

?>
<div class="register-bewerbung" ng-controller="MarkedJobController">
    
    <div class="register-bewerbung-title j2jblueback">
    	<?php echo Yii::t('app', 'Mein gemerkte Stellenanzeigen'); ?>
    </div>
     
    <div class="job-adv-list">
    	
		<div ng-if="markedlist.length == 0"><?php echo Yii::t('app', 'keine gemerkte Stellenanzeigen!');?></div>    	
    	<div class="job-adv-list-item" ng-class="{ 'job-adv-list-item-notapp' : item.status != 1 }" ng-repeat="item in markedlist">
    		<div class="title">{{item.jobtitle}}</div>
    		<div class="delete" title="<?php echo Yii::t('app', 'Löschen'); ?>"><a href="<?=Yii::getAlias('@web') ?>/candidate/dashboard/deletemarkedjob?id={{item.id}}" class="delete"></a></div>
    		<div class="edit" title="<?php echo Yii::t('app', 'Ansehen'); ?>"><a href="<?=Yii::getAlias('@web') ?>/site/jobview?id={{item.id}}" target="_blank" ><span class="glyphicon glyphicon-new-window"></span></a></div>
    		<div class="status"><span ng-if="item.status == 1" ><?php echo Yii::t('app', 'bestätigt');?></span><span ng-if="item.status != 1" ><?php echo Yii::t('app', 'nicht bestätigt');?></span></div>
    		<div class="date">{{item.jobstartdate}}</div>
    		<div class="place">{{item.country}}/{{item.city}}</div>
    	</div>
    	<div class="clear"></div>
    	
    </div>
     
	<div ng-show="loadingshow" class="fade-in-out" style="background-color:rgba(200, 200, 200, 0.5); position: absolute; left:0; top: 0; width: 100%; height: calc(100%);"></div>
</div>

<script>
	var markedadvurl = "<?php echo Yii::getAlias('@web/candidate/markedjoblistjson'); ?>";

</script>




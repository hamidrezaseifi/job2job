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

$formatter = \Yii::$app->formatter;

?>
<div class="register-bewerbung">
    
    <div class="register-bewerbung-title j2jgreenback">
    	<?php echo Yii::t('app', 'Mein Job Anzeigen'); ?>
    </div>
    
    <div class="job-adv-toolbar">
    	<a href="<?=Yii::getAlias('@web') ?>/company/dashboard/newjob" class="new-adv"><b style="font-size: 18px">+</b> &nbsp; &nbsp;<?php echo Yii::t('app', 'Neue Anzeige'); ?></a>
    </div>
     
    <div class="job-adv-list">
    	
    	<?php foreach ($jobadvList as $jobadv){
    		$jobtitle = strlen($jobadv->title) > 22 ? substr($jobadv->title , 0 , 20) . ' ...' : $jobadv->title;
    		?>
    	<div class="job-adv-list-item<?php echo $jobadv->status == 1 ? '' : ' job-adv-list-item-notapp';?>">
    		<div class="title"><?php echo $jobtitle;?></div>
    		<div class="delete" title="<?php echo Yii::t('app', 'Löschen'); ?>"><a href="<?=Yii::getAlias('@web') ?>/company/dashboard/deletejob?id=<?php echo $jobadv->id ?>" class="delete"></a></div>
    		<div class="edit" title="<?php echo Yii::t('app', 'Bearbeiten'); ?>"><a href="<?=Yii::getAlias('@web') ?>/company/dashboard/editjob?id=<?php echo $jobadv->id ?>" class="edit"></a></div>
    		<div class="status"><?php echo $jobadv->status == 1 ? Yii::t('app', 'bestätigt') : Yii::t('app', 'nicht bestätigt');?></div>
    		<div class="date"><?php echo $formatter->asDate($jobadv->jobstartdate, 'php:d.m.Y');?></div>
    		<div class="place"><?php echo $jobadv->country . '/' . $jobadv->city;?></div>
    	</div>
    	<div class="clear"></div>
    	<?php } ?>
    </div>
     

</div>




<?php
/* @var $this \yii\web\View */
/* @var $content string */
/* @var $percentCalc integer */
/* @var $percentTotal integer */
/* @var $photopath string */
/* @var $photo_approved boolean */

use yii\helpers\Html;

$this->registerCssFile("@web/web/css/dashboard.css", [], 'css-dashboard');

$photopath = $photopath && $photo_approved ? $photopath : Yii::getAlias('@web') . '/web/images/person2_blue.png';

$percent = round( ($percentCalc * 100) / $percentTotal );;

?>
<script type="text/javascript">
	var percentCalc = <?php echo $percentCalc;?>, percentTotal = <?php echo $percentTotal;?>;
</script>
<div class="dashbaord-left-panel" style="">
	<div class="personal-info">
		<img src="<?=$photopath ?>" alt="" class="personalphoto2" >
		<div class="personal-name"><?php echo Yii::t('app', 'Guten Tag'); ?><br><?=Yii::$app->user->identity->company()->companyname ?></div>
		<div style="clear:both;"></div>
        <div class="progress" style="margin: 10px 0;">
          <div class="progress-bar" role="progressbar" style="width: <?php echo $percent ?>%; background-color: #72a84f;" aria-valuenow="<?php echo $percent ?>" aria-valuemin="0" aria-valuemax="100"><?php echo $percent ?>%</div>
        </div>		
	</div>
	
	<div class="dashbaord-link"><a href="<?php echo Yii::getAlias('@web/company/dashboard/index') ?>"><?php echo Yii::t('app', 'Dashboard'); ?></a></div>
	<div class="dashbaord-link"><a href="<?php echo Yii::getAlias('@web/company/dashboard/myprofile') ?>"><?php echo Yii::t('app', 'Profil'); ?></a></div>
	<div class="dashbaord-link"><a href="<?php echo Yii::getAlias('@web/company/dashboard/jobs') ?>"><?php echo Yii::t('app', 'Job Anzeigen'); ?></a></div>
	<div class="dashbaord-link"><a href="<?php echo Yii::getAlias('@web/company/dashboard/messages') ?>"><?php echo Yii::t('app', 'Nachrichten'); ?></a></div>
	<div class="dashbaord-link"><a href="<?php echo Yii::getAlias('@web/site/logout') ?>"><?php echo Yii::t('app', 'Abmelden'); ?></a></div>

</div>
<div class="dashbaord-top-panel" style="">
	<div class="personal-info">
		<img src="<?=$photopath ?>" alt="" class="personalphoto2" >
		<div class="personal-name"><?php echo Yii::t('app', 'Guten Tag'); ?><br><?=Yii::$app->user->identity->company()->companyname ?></div>
		<div class="clear"></div>
        <div class="progress" style="margin: 10px 0;">
          <div class="progress-bar" role="progressbar" style="width: <?php echo $percent ?>%; background-color: #72a84f;" aria-valuenow="<?php echo $percent ?>" aria-valuemin="0" aria-valuemax="100"><?php echo $percent ?>%</div>
        </div>		
	</div>

</div>
<div id="company_dashboard_parent" class="company_dashboard_parent" style="">

<?= $content ?>

</div>
<div style="clear: both;"></div>
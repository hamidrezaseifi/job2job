<?php
/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Html;

$this->registerCssFile("@web/web/css/dashboard.css", [], 'css-dashboard');
$this->registerJsFile("@web/web/js/dashboardbewerbung.js", [], 'js-dashboardbewerbung');

$photopath = $photopath && $photo_approved ? $photopath : Yii::getAlias('@web') . '/web/images/person2.png';
// $percentCalc  $percentTotal
//dashboard_bewerber.css
?>
<script type="text/javascript">
	var percentCalc = <?php echo $percentCalc;?>, percentTotal = <?php echo $percentTotal;?>;
</script>
<div class="dashbaord-left-panel" style="">
	<div class="personal-info">
		<img src="<?=$photopath ?>" alt="" class="personalphoto2" >
		<div class="personal-name"><?php echo Yii::t('app', 'Guten Tag'); ?><br><?=Yii::$app->user->identity->fullname() ?></div>
		<div style="clear:both;"></div>
		<div id="progressbar" style="clear:both;"><div class="progress-label" ><?php echo round( ($percentCalc * 100) / $percentTotal ); ?>%</div></div>
	</div>
	
	<div class="dashbaord-link"><a href="<?php echo Yii::getAlias('@web/candidate/dashboard/index') ?>"><?php echo Yii::t('app', 'Dashboard'); ?></a></div>
	<div class="dashbaord-link"><a href="<?php echo Yii::getAlias('@web/candidate/dashboard/myprofile') ?>"><?php echo Yii::t('app', 'Profil'); ?></a></div>
	<div class="dashbaord-link"><a href="<?php echo Yii::getAlias('@web/candidate/dashboard/markedjob') ?>"><?php echo Yii::t('app', 'Gemerkte Anzeigen'); ?></a></div>
	<div class="dashbaord-link"><a href="<?php echo Yii::getAlias('@web/candidate/dashboard/applyjob') ?>"><?php echo Yii::t('app', 'Beworbene Anzeigen'); ?></a></div>
	<div class="dashbaord-link"><a href="<?php echo Yii::getAlias('@web/candidate/dashboard/messages') ?>"><?php echo Yii::t('app', 'Nachrichten'); ?></a></div>
	<div class="dashbaord-link"><a href="<?php echo Yii::getAlias('@web/site/logout') ?>"><?php echo Yii::t('app', 'Abmelden'); ?></a></div>

</div>
<div id="candidate_dashboard_parent" class="candidate_dashboard_parent" style="">

<?= $content ?>

</div>
<div style="clear: both;"></div>
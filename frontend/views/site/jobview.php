<?php
/* @var $this yii\web\View */
/* @var $jobModel common\lib\JobpositionBase */
/* @var $favModel common\lib\CandidatefavoriteBase */
/* @var $applyModel common\lib\CandidatejobapplyBase */
/* @var $id integer */

use yii\helpers\Html;
use common\helper\BrainStaticList;
use yii\bootstrap\ActiveForm;

$this->registerCssFile("@web/web/css/jobview.css", [], 'css-jobview');
$this->registerCssFile("@web/web/css/styleradio.css", [], 'css-style-radio');
$this->registerCssFile("@web/web/css/stylecheckbox.css", [], 'css-style-checkbox');
$this->registerJsFile("@web/web/js/jobview.js", [], 'js-jobview');

Yii::$app->formatter->locale = 'de-DE';
$startmonths =  Yii::$app->formatter->asDate($jobModel->jobstartdate, 'php:F');;
$startyear =  Yii::$app->formatter->asDate($jobModel->jobstartdate, 'php:Y');;

$faveimage = $favModel ? 'favorite_full.png' : 'favorite_empty.png';

$userid = 0;
$usertel = '';
$userfullname = '';

if(!Yii::$app->user->isGuest && Yii::$app->user->identity)
{
	$userid = Yii::$app->user->identity->id;
	$userfullname = Yii::$app->user->identity->fullname();
	if(Yii::$app->user->identity->isCandidate())
	{
		$usertel = Yii::$app->user->identity->candidate()->tel;
	}
	if(Yii::$app->user->identity->isCompany())
	{
		$usertel = Yii::$app->user->identity->personalDecisionMaker()->tel;
	}
}

//print_r($_SERVER); exit;
?>


<div class="jobview-jobpanel">
    
    <div class="jobview-pagetitle j2jgreenback">
    	<?php echo $jobModel->title; ?>
    </div>
    <?php if(!Yii::$app->user->isGuest && Yii::$app->user->identity && Yii::$app->user->identity->isCandidate()) {?>
    <div class="jobview-favstar">
    	<a href="<?=Yii::getAlias('@web') ?>/candidate/jobfav?id=<?=$jobModel->id ?>"><img alt="" src="<?php echo Yii::getAlias('@web')?>/web/images/<?=$faveimage ?>" width="60"></a>
    </div>
    
	<?php } ?>
	
    <div class="clear"></div>
    
   	<div class="jobview-ort ">
    	<?php echo Yii::t('app', 'Für einen Einsatz in ') . $jobModel->city . ' (' . $jobModel->postcode . ') ' . Yii::t('app', ' suchen wir:'); ?>
    </div>

    <div class="jobview-jobtitle">
    	<?php echo $jobModel->title; ?>
    </div>
    
    <?php if(!Yii::$app->user->isGuest && Yii::$app->user->identity && Yii::$app->user->identity->isCandidate()) {?> 	
    <div><a href="<?=Yii::getAlias('@web') ?>/candidate/jobapply?id=<?=$jobModel->id ?>" class="buttonbewerben<?=($applyModel ? ' disabled-link' : '') ?>"><?php echo $applyModel ? Yii::t('app', 'schon beworben') : Yii::t('app', 'Jetzt bewerben'); ?></a></div><div class="clear"></div>
	<?php } else {?>
    <div style="height: 20px;"></div>
	
	<?php } ?>
    
   	<div class="jobview-detail ">
    	<?php echo '<b>' . Yii::t('app', 'Arbeitszeitmodel') . ':</b> ' . BrainStaticList::workTypeList()[$jobModel->worktype]; ?>
    </div>
    
   	<div class="jobview-detail ">
    	<?php echo '<b>' . Yii::t('app', 'Vakanz') . ':</b> ' . BrainStaticList::vacancyList()[$jobModel->vacancy]; ?>
    </div>
    
   	<div class="jobview-detail ">
    	<?php echo '<b>' . Yii::t('app', 'Job-Beginn und Dauer') . ':</b> ' . $startmonths . ' ' . $startyear . ', ' . $jobModel->duration . ' ' . Yii::t('app', 'Monat(e)'). ($jobModel->extends == 1 ? ' ' . Yii::t('app', ', Verlängerung möglich'): ''); ?>
    </div>
    
   	<div class="jobview-detail ">
    	<?php echo '<b>' . Yii::t('app', 'Hauptkategorie') . ':</b> ' . BrainStaticList::jobTypeList()[$jobModel->jobtype]; ?>
    </div>
    
   	<div class="jobview-comments ">
    	<?php echo nl2br($jobModel->comments); ?>
    </div>
    <?php if(!Yii::$app->user->isGuest && Yii::$app->user->identity && Yii::$app->user->identity->isCandidate()) {?>
    <div><a href="<?=Yii::getAlias('@web') ?>/candidate/jobapply?id=<?=$jobModel->id ?>" class="buttonbewerben<?=($applyModel ? ' disabled-link' : '') ?>"><?php echo $applyModel ? Yii::t('app', 'schon beworben') : Yii::t('app', 'Jetzt bewerben'); ?></a></div><div class="clear"></div>
    <?php } ?>
</div>
<div class="jobview-rightpanel j2jgreenback">
	<div class="desc"><?php echo Yii::t('app', 'Hat diese Anzeige Ihr Interesse geweckt?<br>Dann sprechen Sie uns an!'); ?></div>
	<br>
	<div class="desc"><?php echo Yii::t('app', 'Telefon:'); ?><br><a class="tel" href="tel:0511645742542">0511645742542</a></div>
	<br>
	<div class="desc"><?php echo Yii::t('app', 'E-Mail:'); ?><br><a class="email" href="mailto:bewerbung@job2job.de">bewerbung@job2job.de</a></div>
	<br>
	<div class="desc2"><?php echo Yii::t('app', 'Postanschrift:'); ?><br><br>Job2Job<br>Bad Pyrmonter Straße 42<br>31576 Hameln</div>
	<div class="call-request"><?php echo Yii::t('app', 'Bitte um Rückruf'); ?></div>
	<div class="job-print"><?php echo Yii::t('app', 'Stellenanzeige drucken'); ?></div>
	<a href="mailto:?subject=<?php echo $jobModel->title; ?>&body=Folgende Stellenanzeige empfehle ich Ihnen: <?=isset($_SERVER['HTTPS']) ? "https://" : "http://" . $_SERVER['HTTP_HOST'] . Yii::getAlias('@web') ?>/site/jobview?id=<?php echo $jobModel->id;?>"><div class="job-sendemail"><?php echo Yii::t('app', 'An Freunde senden'); ?></div></a>
</div>
<div class="clear"></div>

<div id="callpannel">
	<div class="sendcontainer">
	<?php ActiveForm::begin(['action' => Yii::getAlias('@web') . '/site/callrequest', 'id' => 'sendrequestform', 'method' => 'post'])?>
	<div class="title"><?php echo Yii::t('app', 'Bitte um Rückruf'); ?></div>
	<div class="desc"><?php echo Yii::t('app', 'Vielen Dank für Ihr Interesse an einer Mitarbeit bei job2job.'); ?></div>
	<div class="desc"><?php echo Yii::t('app', 'Bitte senden Sie uns Ihre Kontaktdaten und Anfrage, wir rufen Sie gerne zurück!'); ?></div>
	<br>
	<div class="desc2"><?php echo Yii::t('app', 'Füllen Sie vor dem Absenden mindestens die mit * markierten Felder aus.'); ?></div>
	
	<div class="j2jgreentext"><?php echo Yii::t('app', 'Ihr Name*'); ?></div>
	<div class="data"><input name="CallrequestBase[name]" type="text" required="required" value="<?php echo $userfullname;?>" ></div>
	<div class="j2jgreentext"><?php echo Yii::t('app', 'Ihre Telefonnummer*'); ?></div>
	<div class="data"><input name="CallrequestBase[tel]" type="text" required="required" value="<?php echo $usertel;?>" ></div>
	<div class="j2jgreentext"><?php echo Yii::t('app', 'Ihre Mitteilung'); ?></div>
	<div class="data"><textarea name="CallrequestBase[message]"></textarea></div>
	<div class="j2jgreenback sendbutton"><?php echo Yii::t('app', 'absenden'); ?></div>
	<input type="hidden" name="CallrequestBase[status]" value="0">
	<input type="hidden" name="CallrequestBase[userid]" value="<?php echo $userid;?>">
	<?php ActiveForm::end()?>
	</div>
	<div class="responsecontainer">
		<div class="title2"><?php echo Yii::t('app', 'Vielen Dank für ihre Mitteilung'); ?></div>
		<div class="j2jgreentext"><?php echo Yii::t('app', 'Wir melden uns so bald wie möglich zurück'); ?></div>
	</div>
	
</div>



<script type="text/javascript">




</script>
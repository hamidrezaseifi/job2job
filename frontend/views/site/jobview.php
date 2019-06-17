<?php
/* @var $this yii\web\View */
/* @var $jobModel common\lib\JobpositionBase */
/* @var $isFavorite boolean */
/* @var $isApplied boolean */
/* @var $id integer */
/* @var $startDate string */
/* @var $endDate string */
/* @var $duration integer */
/* @var $tasks array */
/* @var $skills array */

use yii\bootstrap\ActiveForm;

$this->registerCssFile("@web/web/css/jobview.css", [], 'css-jobview');
$this->registerJsFile("@web/web/js/jobview.js", [], 'js-jobview');

Yii::$app->formatter->locale = 'de-DE';

$faveimage = $isFavorite ? 'favorite_blue.png' : 'favorite_empty_blue.png';

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

$user = Yii::$app->user;
$identity = $user->identity;
$isCandidate = $identity ? $identity->isCandidate() : false;

//print_r($_SERVER); exit;
?>

<div ng-controller="JobviewController">

    <div class="jobview-jobpanel">
        
        <div class="jobview-pagetitle">
        	<?php echo $jobModel->title; ?> <span class="job-title-gender">( m / w / d )</span>
        	
        </div>
        <?php if(!Yii::$app->user->isGuest && Yii::$app->user->identity && Yii::$app->user->identity->isCandidate() && false) {?>
        <div class="jobview-favstar">
        	<a href="<?=Yii::getAlias('@web') ?>/candidate/jobfav?id=<?=$jobModel->id ?>"><img alt="" src="<?php echo Yii::getAlias('@web')?>/web/images/<?=$faveimage ?>" width="60"></a>
        </div>
    	<?php } ?>
    	
        <div class="clear"></div>
        
       	<div class="jobview-container">
           	<div class="jobview-info">
           		<div>
           			<span>Projekt-ID: </span> <?php echo $jobModel->id;?>
    			<?php if($isCandidate){?>
    			<img class="fav-image" alt="" ng-click="toggleFavoriote(<?php echo $jobModel->id?>)"  ng-src="<?php echo Yii::getAlias("@web");?>/web/images/{{getFavImageName()}}">
    			<?php } else {?>
    			
    			<?php } ?>
           			
           		</div>
           		<div><span>Branche: </span> <?php echo $jobModel->getBranch()->one()->title;?></div>
           		<div><span>Einsatzort: </span> <?php echo $jobModel->city;?></div>
           		<div><span>Arbeitszeitmodel: </span> <?php echo $jobModel->getWorktype()->one()->title;?></div>
           		<div><span>Beschäftigungsbeginn: </span> <?php echo $startDate;?></div>
           		<div><span>Dauer: </span> <?php echo $duration;?></div>
            </div>
            
           	<div class="jobview-twinbox jobview-tasks">
           		<div class="tasks-title">Ihre Aufgaben:</div>
           		<ul style="height: 220px; overflow-y: hidden; margin-left: -10px;">
           			<?php foreach($tasks as $task){?>
           			<li style="margin-left: 20px;"><?php echo $task->task?></li>
           			<?php } ?>
           		</ul>
            </div>
            
           	<div class="jobview-twinbox jobview-skills">
           		<div class="skills-title">Ihre Qualifikationen:</div>
           		<ul style="height: 220px; overflow-y: hidden; margin-left: -10px;">
           			<?php foreach($skills as $skill){?>
           			<li style="margin-left: 20px;"><?php echo $skill->skill?></li>
           			<?php } ?>
           		</ul>
            </div>
            <div class="clear"></div>
        </div>
        
        <?php if(!Yii::$app->user->isGuest && Yii::$app->user->identity && Yii::$app->user->identity->isCandidate() && false) {?> 	
        <div><a href="<?=Yii::getAlias('@web') ?>/candidate/jobapply?id=<?=$jobModel->id ?>" class="buttonbewerben<?=($isApplied ? ' disabled-link' : '') ?>"><?php echo $isApplied ? Yii::t('app', 'schon beworben') : Yii::t('app', 'Jetzt bewerben'); ?></a></div><div class="clear"></div>
    	<?php } ?>
    
        <?php if(!Yii::$app->user->isGuest && Yii::$app->user->identity && Yii::$app->user->identity->isCandidate() && false) {?>
        <div><a href="<?=Yii::getAlias('@web') ?>/candidate/jobapply?id=<?=$jobModel->id ?>" class="buttonbewerben<?=($isApplied ? ' disabled-link' : '') ?>"><?php echo $isApplied ? Yii::t('app', 'schon beworben') : Yii::t('app', 'Jetzt bewerben'); ?></a></div><div class="clear"></div>
        <?php } ?>
    </div>
    <div class="jobview-rightpanel">
    	<div class="desc"><?php echo Yii::t('app', 'Hat diese Anzeige Ihr Interesse geweckt?<br>Dann sprechen Sie uns an!'); ?></div>
    	<br>
    	<div class="desc"><?php echo Yii::t('app', 'Telefon:'); ?><br><a class="tel" href="tel:+4951515569430">+49 5151/55694-30</a></div>
    	<br>
    	<div class="desc"><?php echo Yii::t('app', 'E-Mail:'); ?><br><a class="email" href="mailto:info@job2job-gmbh.de">info@job2job-gmbh.de</a></div>
    	<br>
    	<div class="desc2"><?php echo Yii::t('app', 'Postanschrift:'); ?><br><br>Job2Job<br>Pyrmonter Straße 42<br>31789 Hameln</div>
    	<div class="call-request" ng-click="showCallMe()"><?php echo Yii::t('app', 'Bitte um Rückruf'); ?></div>
    	<div class="job-print" ng-click="printjob()"><?php echo Yii::t('app', 'Stellenanzeige drucken'); ?></div>
    	<a href="mailto:?subject=<?php echo $jobModel->title; ?>&body=Folgende Stellenanzeige empfehle ich Ihnen: <?=isset($_SERVER['HTTPS']) ? "https://" : "http://" . $_SERVER['HTTP_HOST'] . Yii::getAlias('@web') ?>/site/jobview?id=<?php echo $jobModel->id;?>"><div class="job-sendemail"><?php echo Yii::t('app', 'An Freunde senden'); ?></div></a>
    </div>
    <div class="clear"></div>
    
    <div id="callpannel">
    	<div class="sendcontainer">
    	<div class="title"><?php echo Yii::t('app', 'Bitte um Rückruf'); ?></div>
    	<div class="desc"><?php echo Yii::t('app', 'Vielen Dank für Ihr Interesse an einer Mitarbeit bei job2job.'); ?></div>
    	<div class="desc"><?php echo Yii::t('app', 'Bitte senden Sie uns Ihre Kontaktdaten und Anfrage, wir rufen Sie gerne zurück!'); ?></div>
    	<br>
    	<div class="desc2"><?php echo Yii::t('app', 'Füllen Sie vor dem Absenden mindestens die mit * markierten Felder aus.'); ?></div>
    	
    	<div class="j2jgreentext"><?php echo Yii::t('app', 'Ihr Name*'); ?></div>
    	<div class="data"><input ng-model="sendrequest.fullname" type="text" required="required" value="<?php echo $userfullname;?>" ></div>
    	<div class="j2jgreentext"><?php echo Yii::t('app', 'Ihre Telefonnummer*'); ?></div>
    	<div class="data"><input ng-model="sendrequest.tel" type="text" required="required" value="<?php echo $usertel;?>" ></div>
    	<div class="j2jgreentext"><?php echo Yii::t('app', 'Ihre Mitteilung'); ?></div>
    	<div class="data"><textarea ng-model="sendrequest.msg" ></textarea></div>
    	
    	<div class="sendbutton" ng-class="{'sending' : isSendingInValid()}" ng-click="sendCallMe()"><?php echo Yii::t('app', 'absenden'); ?></div>
    	</div>
    	<div class="responsecontainer">
    		<div class="title2"><?php echo Yii::t('app', 'Vielen Dank für ihre Mitteilung'); ?></div>
    		<div class="j2jgreentext"><?php echo Yii::t('app', 'Wir melden uns so bald wie möglich zurück'); ?></div>
    	</div>
    	
    </div>
    <br><br><br>
    
    
    <script type="text/javascript">
	    var addtofavurl = "<?php echo Yii::getAlias("@web") . "/candidate/jobfav"; ?>";
	    var isFavorite = <?php echo $isFavorite ? 'true' : 'false';?>;
	    var callrequesturl = "<?php echo Yii::getAlias("@web") . "/site/callrequest"; ?>";
    </script>

</div>

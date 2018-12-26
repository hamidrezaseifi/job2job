<?php

/* @var $this yii\web\View */
/* @var $model \common\models\Users */
/* @var $candidateModel \common\lib\CandidateBase */
/* @var $skills array */
/* @var $nationalities \common\lib\NationalityBase */
/* @var $countries \common\lib\CountryBase */
/* @var $distances \common\lib\DistanceBase */
/* @var $worktypes \common\lib\WorktimemodelBase */

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;

$this->registerCssFile("@web/web/css/regbewerbungresp.css", [], 'css-bewerbungresp');
/*$this->registerCssFile("@web/web/css/styleradio.css", [], 'css-style-radio');
$this->registerCssFile("@web/web/css/stylecheckbox.css", [], 'css-style-checkbox');
$this->registerJsFile("@web/web/js/regbewerbung.js", [], 'js-bewerbung');*/
//$skills



?>
<div class="register-bewerbung-response">
    
    <div class="register-bewerbung-response-title ">
    	<img alt="" class="topbanner" src="<?=Yii::getAlias('@web/web/images') ?>/reg_bewerb_succesfull.png">
    	<div class="title-text brandarkbluetext">
    		<div class="title-text-1"><?=Yii::t('app', 'Willkommen bei'); ?></div>
    		<div class="title-text-2"><?=Yii::t('app', 'Job<span class="j2jgreentext">2</span>Job'); ?></div>
    		<div class="title-text-3"><?=Yii::t('app', 'Fast geschafft'); ?></div>
    	</div>
    </div>
    <div class="clear"></div>
    <div class="register-bewerbung-response-content">
    	<div class="register-bewerbung-response-title1"><?=Yii::t('app', 'AKTIVIEREN SIE JETZT NOCH IHR PROFIL'); ?></div>
   		<div class="register-bewerbung-response-title2"><?=Yii::t('app', 'Sie erhalten in Kürze eine E-Mail mit einem Aktivierungslink, um Ihr Profil freizuschalten.'); ?></div>
   		<div class="register-bewerbung-response-text1"><?=Yii::t('app', 'Falls Sie keine E-Mail von uns erhalten, überprüfen Sie bitte den Spam Ordner Ihres E-Mail-Postfaches. <br>(Tipp: Wenn Sie unsere Absender-Adresse Ihrem E-Mail-Adressbuch hinzufügen, können Sie dieses Problem zukünftig vermeiden).'); ?></div>
   		<div class="register-bewerbung-response-text1"><?=Yii::t('app', 'Sollten Sie trotzdem keine E-Mail mit einem Aktivierungslink erhalten, kontaktieren Sie uns unter '); ?><a href="mailto:info@job2job-gmbh.de" class="j2jgreentext">info@job2job-gmbh.de</a></div>
    	<br><br>
       	<div class="register-bewerbung-response-title1"><?=Yii::t('app', 'NÄCHSTE SCHRITTE'); ?></div>
    	<div class="register-bewerbung-response-down-container">
    		<div class="register-bewerbung-response-down-item">
    			<div><img alt="" src="<?=Yii::getAlias('@web/web/images/') ?>green-pen-write.png" width="80"><br></div>
    			<div class="down-title-text"><?=Yii::t('app', '1. PROFIL AUSFÜLLEN'); ?></div>
    			<div class="down-text"><?=Yii::t('app', 'Vervollständigen Sie ggf. Ihre Profildaten noch mit CV und Foto. Dies erhöht Ihre Chance auf Einsatzanfragen wesentlich.'); ?></div>
    		</div>

    		<div class="register-bewerbung-response-down-item">
    			<div><img alt="" src="<?=Yii::getAlias('@web/web/images/') ?>green-buble.png" width="80"><br></div>
    			<div class="down-title-text"><?=Yii::t('app', '1. ANFRAGEN ERHALTEN'); ?></div>
    			<div class="down-text"><?=Yii::t('app', 'Warten Sie ab. Passt Ihr Profil zu einem Einsatz, erhalten Sie per E-Mail eine Einsatzanfrage.'); ?></div>
    		</div>

    		<div class="register-bewerbung-response-down-item">
    			<div><img alt="" src="<?=Yii::getAlias('@web/web/images/') ?>green-hand-ok.png" width="80"><br></div>
    			<div class="down-title-text"><?=Yii::t('app', '3. ZU- ODER ABSAGEN'); ?></div>
    			<div class="down-text"><?=Yii::t('app', 'Auf Anfragen können Sie Ihr Interesse bekunden oder absagen. Einfach per Klick auf den entsprechenden Button im Mail.'); ?></div>
    		</div>

    		<div class="register-bewerbung-response-down-item">
    			<div><img alt="" src="<?=Yii::getAlias('@web/web/images/') ?>green-users.png" width="80"><br></div>
    			<div class="down-title-text"><?=Yii::t('app', '4. ARBEITEN'); ?></div>
    			<div class="down-text"><?=Yii::t('app', 'Wenn der Arbeitgeber Sie annimmt, erhalten Sie eine Zusage per Mail inkl. Vertrag. Der Einsatz kann beginnen!'); ?></div>
    		</div>

    	</div>
    	<div class="clear" style="border-bottom: 1px solid #eeeeee;"></div>
    	<br>
    	<div>
    		<a class="j2jgreentext start-page-button ui-button ui-corner-all ui-widget" style="float: right; color: #a9cb14; padding: 10px; padding-left: 15px; padding-right: 15px; font-size: 14px;" role="button" href="#" id="manualjobsearch"><?=Yii::t('app', 'Zur manuellen Jobsuche  >>  '); ?></a>
    	</div>
    </div>
</div>
     
<script>
	
	
</script>
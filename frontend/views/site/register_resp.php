<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \frontend\models\LoginForm */
/* @var $adminemail string */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

$this->registerCssFile("@web/web/css/register.css", [], 'css-register');
$this->registerCssFile("@web/web/css/regbewerbungresp.css", [], 'css-bewerbungresp');

$this->title = 'Login';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-register">
    
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
   		<div class="register-bewerbung-response-text1"><?=Yii::t('app', 'Sollten Sie trotzdem keine E-Mail mit einem Aktivierungslink erhalten, kontaktieren Sie uns unter '); ?><a href="mailto:<?php echo $adminemail; ?>" class="j2jgreentext"><?php echo $adminemail; ?></a></div>
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
    			<div class="down-title-text"><?=Yii::t('app', '2. ANFRAGEN ERHALTEN'); ?></div>
    			<div class="down-text"><?=Yii::t('app', 'Warten Sie ab. Passt Ihr Profil zu einem Einsatz, erhalten Sie per E-Mail oder per Telefon eine Einsatzanfrage.'); ?></div>
    		</div>

    		<div class="register-bewerbung-response-down-item">
    			<div><img alt="" src="<?=Yii::getAlias('@web/web/images/') ?>green-users.png" width="80"><br></div>
    			<div class="down-title-text"><?=Yii::t('app', '3. ARBEITEN'); ?></div>
    			<div class="down-text"><?=Yii::t('app', 'Wenn der Arbeitgeber Sie annimmt, erhalten Sie eine Zusage per Mail inkl. Vertrag. Der Einsatz kann beginnen!'); ?></div>
    		</div>

    	</div>
    	<div class="clear" style="border-bottom: 1px solid #eeeeee;"></div>
    	<br>
    </div>
	<div class="clear"></div> 

</div>


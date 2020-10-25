<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \frontend\models\ContactForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\captcha\Captcha;

$this->registerCssFile("@web/web/css/braches.css", [], 'css-braches');
$this->registerCssFile("@web/web/css/imageheader.css", [], 'css-imageheader');
$this->registerCssFile("@web/web/css/contact.css", [], 'css-contact');
$this->registerJsFile("@web/web/js/contact.js", [], 'js-contact');

?>


<div class="site-contact-container" ng-controller="ContactController">

	<div class="anim-image-header" style="background-image: url(<?=Yii::getAlias('@web')?>/web/images/contact-back.jpg); background-size: 100% 100%;">

			<div class="anim-image-title">
				Kontaktmöglichkeiten
			</div>
	</div>

	<div class="contact-container">
	
		<div class="branch-button-bar">
			<button type="button" class="contect-branch-button" style="margin-right: 10px" ng-class="{'sel' : branch == 'hameln'}" ng-click="setBranch('hameln')">Hameln</button>
			<button type="button" class="contect-branch-button" style="margin-left: 10px" ng-class="{'sel' : branch == 'minden'}" ng-click="setBranch('minden')">Minden</button>
		</div>
		<div class="site-contact-detail">
    		<div class="site-contact-detail-top" ng-if="branch == 'hameln'">
                <div class="site-contact-top-left">
                    Job2Job GmbH<br>
                	Wendenstraße 4<br>
                	31785 Hameln<br>
            	</div>
                <div class="site-contact-top-right">
                    Tel.: +49 5151/55694-30<br>
                	Fax: +49 5151/55694-24<br>
                	Email: info@job2job-gmbh.de<br>
            	</div>
    			<div class="clear"></div>
    		</div>

    		<div class="site-contact-detail-top" ng-if="branch == 'minden'">
                <div class="site-contact-top-left">
                    Job2Job GmbH<br>
                	Karolingerring 62<br>
                	32423 Minden<br>
            	</div>
                <div class="site-contact-top-right">
                    Tel.: +49 571/40493170<br>
                	Email: info@job2job-gmbh.de<br>
            	</div>
    			<div class="clear"></div>
    		</div>
    		
    		<div class="site-contact-form">
                <form action="" >
                	<div class="form-part-left" ng-if="!messageIsSent">
                     	<label>Name/Firma</label><br>
                    	<input type="text" required="required" name="name" ng-model="message.name" placeholder="<?= Yii::t('app' , 'Name') ?>" class="contect-name"><br>
                    	<label>E-Mail</label><br>
                    	<input type="text" required="required" name="email" ng-model="message.email" placeholder="<?= Yii::t('app' , 'E-Mail-Adresse') ?>" class="contect-email"><br>
                    	<label>Betreff</label><br>
                    	<input type="text" required="required" name="title" ng-model="message.title" placeholder="<?= Yii::t('app' , 'Betreff') ?>" class="contect-title"><br>               	
                	</div>
                	<div class="form-part-right" ng-if="!messageIsSent">
                     	<label>Nachricht</label><br>
                		<textarea name="text" required="required" ng-model="message.message" placeholder="<?= Yii::t('app' , 'Nachricht') ?>" maxlength="200" class="contect-text"></textarea><br>
                		
                	</div>
            		<div class="message-sent-message"  ng-show="messageIsSent">
            			<h4>Ihre Nachricht wurde erfolgreich verschickt!</h4>
            			<img src="https://aristo-group.com/wp-content/themes/aristo/img/passresetcheck.gif">
            		</div>
                	
                	<div class="clear"></div>                	
                	<div class="form-send">
                     	<button type="button" ng-if="!messageIsSent" ng-click="sendMessage();" class="contect-send"><?= Yii::t('app' , 'Senden') ?></button>
                     	<button type="button" ng-if="messageIsSent" ng-click="resetMessage();" class="contect-send"><?= Yii::t('app' , 'Weitere Nachricht') ?></button>
                	</div>
                	
                </form>
    		
    		</div>
	
		</div>
		
		<div class="site-contact-map">
			<iframe id="googlemap" height="350"
				  src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2450.71684400714!2d9.353286351957733!3d52.10308467963807!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x47ba8ef1e11ac88b%3A0xbd8b0f01b0414903!2sWendenstra%C3%9Fe%204%2C%2031785%20Hameln!5e0!3m2!1sde!2sde!4v1603635537856!5m2!1sde!2sde&q=Job2Job+GmbH" >
				</iframe>
		
		</div>	
		<div class="clear"></div>	
	</div>



</div>


<div class="site-contact-parent" style="display: none">

	<div class="site-contact brandarkbluetext">
	    <div class="site-contact-title"><?= Yii::t('app' , 'Wir freuen uns auf Ihre<br>Kontaktaufnahme') ?></div><br>
	
	    <p class="site-contact-text">
	        <?= Yii::t('app' , 'Rufen Sie uns einfach an, oder besuchen Sie uns in Hameln oder nutzen Sie nachstehendes eMail <br>Formular für die Kontaktaufnahme. Informieren Sie sich auch über unsere private Arbeits- und<br>Stellenvermittlung.') ?>
	    </p>
	<br>
		<table style="width:100%;">
			<tr>
				<td style="width:400px;">
				    <div class="site-contact-address"><?= Yii::t('app' , 'Job2Job GmbH') ?></div>
				    <div class="site-contact-address"><?= Yii::t('app' , '31789 Hameln') ?></div>
				    <div class="site-contact-address"><?= Yii::t('app' , 'Pyrmonter Straße 42') ?></div><br><br>
				    <div class="site-contact-address"><?= Yii::t('app' , 'Tel.: 05151/55694-30') ?></div>
				    <div class="site-contact-address"><?= Yii::t('app' , 'Fax: 05151/55694-24') ?></div>
				    <div class="site-contact-address"><?= Yii::t('app' , 'Email: info@job2job-gmbh.de') ?></div>
				    
				    <br>

		            <form action="" >
		            	<input type="text" name="name" placeholder="<?= Yii::t('app' , 'Name') ?>" class="contect-name">
		            	<input type="text" name="email" placeholder="<?= Yii::t('app' , 'E-Mail-Adresse') ?>" class="contect-email"><br>
		            	<input type="text" name="title" placeholder="<?= Yii::t('app' , 'Betreff') ?>" class="contect-title"><br>
		            	<table>
		            		<tr>
		            			<td><textarea name="text" placeholder="<?= Yii::t('app' , 'Nachricht') ?>" maxlength="200" class="contect-text"></textarea></td>
		            			<td style="vertical-align: bottom; padding-bottom:4px; padding-left:3px;"><input type="button" value="<?= Yii::t('app' , 'Send') ?>" class="contect-send"></td>
		            		</tr>
		            	</table>
		            	
		            	
		            </form>
		
				</td>
				<td style="vertical-align: top; padding-left:3px;">
					<iframe width="550" height="350" style="border:0; "
						  src="https://www.google.com/maps/embed/v1/place?key=AIzaSyDiTNNWMEMkS_pNc0OxdVGKjfVIPnxyLKE&q=Job2Job+GmbH" >
						</iframe>
				</td>
			</tr>
		</table>

	<script type="text/javascript">
	var messageurl = "<?php echo Yii::getAlias("@web") ?>/site/contactmessage";
	</script>
	
	</div>
</div>

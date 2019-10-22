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
                	Hefehof 20<br>
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
                	Lindenstraße 5 (am ZOB)<br>
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
                	<div class="form-part-left">
                     	<label>Name/Firma</label><br>
                    	<input type="text" name="name" placeholder="<?= Yii::t('app' , 'Name') ?>" class="contect-name"><br>
                    	<label>E-Mail</label><br>
                    	<input type="text" name="email" placeholder="<?= Yii::t('app' , 'E-Mail-Adresse') ?>" class="contect-email"><br>
                    	<label>Betreff</label><br>
                    	<input type="text" name="title" placeholder="<?= Yii::t('app' , 'Betreff') ?>" class="contect-title"><br>               	
                	</div>
                	<div class="form-part-right">
                     	<label>Nachricht</label><br>
                		<textarea name="text" placeholder="<?= Yii::t('app' , 'Nachricht') ?>" maxlength="200" class="contect-text"></textarea><br>
                		
                	</div>
                	<div class="clear"></div>                	
                	<div class="form-send">
                     	<button type="button" class="contect-send"><?= Yii::t('app' , 'Senden') ?></button>
                	</div>
                	
                </form>
    		
    		</div>
	
		</div>
		
		<div class="site-contact-map">
			<iframe id="googlemap" height="350"
				  src="https://www.google.com/maps/embed/v1/place?key=AIzaSyDiTNNWMEMkS_pNc0OxdVGKjfVIPnxyLKE&q=Job2Job+GmbH" >
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

	
	</div>
</div>

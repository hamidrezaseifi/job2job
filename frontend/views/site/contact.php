<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \frontend\models\ContactForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\captcha\Captcha;

?>
<div class="site-contact-parent">

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

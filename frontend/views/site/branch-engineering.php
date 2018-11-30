<?php

/* @var $this yii\web\View */

use yii\helpers\Html;


?>

<div class="branch-container">

	<div class="branch-header">
			<img src="<?=Yii::getAlias('@web') ?>/web/images/Logistik-1.jpg" alt="" width="100%">
			<div class="branch-image-title">
				<div class="text">
						<?php echo Yii::t('app', 'Lass dich von deinem flexiblen Office Job finden'); ?>
				</div>
			</div>
	</div>
	
	<div class="staticpage-desc">
	    <p><b><?php echo Yii::t('app', 'Ob am Flughafen, im Handel oder im Lager – flexible Mitarbeitende in der modernen Logistik sind immer stärker gesucht. Lass dich jetzt automatisch von zahlreichen Jobs in deiner Umgebung finden.'); ?></b></p>
		<p><?php echo Yii::t('app', 'Ist es dir auch wichtig, dass die Produkte pünktlich in den Regalen der Geschäfte stehen oder dass die online bestellten Artikel zeitgerecht geliefert werden? Wähle bei Coople aus über 10 Jobprofilen aus und arbeite als Logistiker, Lagermitarbeiter oder Staplerfahrer. Registriere dich jetzt kostenlos und erhalte automatisch Jobanfragen in deinen bevorzugten Logistik-Jobs.'); ?></p>
		
		<ul>
			<li><b><?php echo Yii::t('app', 'Job on the go'); ?>:</b> <?php echo Yii::t('app', 'Riesige Auswahl und minimaler Aufwand – dein Job findet dich'); ?></li>
			<li><b><?php echo Yii::t('app', 'Faire Löhne'); ?>:</b> <?php echo Yii::t('app', 'Einhaltung aller Mindestlöhne und gesetzeskonforme Abrechnungen'); ?></li>
			<li><b><?php echo Yii::t('app', 'Transparenz dank Ratingsystem'); ?>:</b> <?php echo Yii::t('app', 'Schaue dir zuerst die Bewertungen von deinen Arbeitgebern an'); ?></li>
			<li><b><?php echo Yii::t('app', 'Flexibel 1-100% arbeiten'); ?>:</b> <?php echo Yii::t('app', 'Gestalte dein Leben individuell und selbstbestimmt'); ?></li>
		</ul>
	
		<br><br><br>
		<div>
			<div style="float: left;">
			
				<p><b><?php echo Yii::t('app', 'Verfügbare Jobprofile bei Job2Job'); ?> </b></p>
				<ul>	
					<li>Logistiker/in</li>
					<li>Hilfskraft Logistik</li>
					<li>Staplerfahrer/in</li>
					<li>Lagermitarbeiter/in</li>
					<li>Reinigungsmitarbeiter/in</li>
					<li>Fahrer/in (bis 3.5t)</li>
					<li>LKW-Fahrer/in (ab 3.5t)</li>
					<li>Flughafenmitarbeiter/in</li>

					<li><a href="javascript:void()">Und mehr</a></li>
				</ul>			
			</div>
			<img style="float: right;" src="<?=Yii::getAlias('@web') ?>/web/images/branch-eng2.jpg" width="360" alt="">
			<div class="clear"></div>
		</div>	
		<br><br><br>
		
	
	</div>

	

</div>


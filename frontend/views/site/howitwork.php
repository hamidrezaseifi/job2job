<?php

/* @var $this yii\web\View */

use yii\helpers\Html;

$this->registerJsFile("@web/web/js/howitworks.js", [], 'js-howitworks');

?>
<div class="site-howitwork">

	<div class="branch-header">
			<img src="<?=Yii::getAlias('@web') ?>/web/images/so-funk.jpg" alt="" width="100%">
			<div class="branch-image-title">
				<div class="text">
					<?php echo Yii::t('app', 'So funktioniert Job2Job'); ?>
				</div>
			</div>
	</div>
	<br>
	<div class="staticpage-desc">
	    <p style="font-size: 22px"><b><?php echo Yii::t('app', 'So funktioniert Job2Job'); ?></b></p>
	    <p><?php echo Yii::t('app', 'Job2Job ist die einfachste und schnellste Verbindung zwischen Arbeitnehmer und Arbeitgeber. Auf dem Online-Marktplatz finden Arbeitgeber und Job2Job mit kleinstem administrativem Aufwand zueinander.'); ?></p>
		<p><?php echo Yii::t('app', 'Mit Job2Job planen Sie Ihren Personaleinsatz ganz einfach mit wenigen Klicks.'); ?></p>
		<p><?php echo Yii::t('app', 'Arbeitnehmer auf der anderen Seite haben so die Möglichkeit, völlig flexibel und selbstbestimmt zu arbeiten. Einfach registrieren, gewünschte Jobprofile auswählen und sich automatisch von Jobs aus verschiedenen Berufsfeldern finden lassen.'); ?></p>
	</div>
	
	<div class="staticpage-desc anim-container" style="">
		<div class="" style="float: left; width: 48%; padding: 10px; padding-right: 30px; border-right: 2px solid #a9cb14; ">
		    <p style="font-size: 22px"><b><?php echo Yii::t('app', 'Arbeitnehmer'); ?></b></p>
		    
		    <ul class="animul animul1">
		    	<li><?php echo Yii::t('app', 'Erstellen Sie ein Profil, laden Sie Ihren CV hoch und geben Sie an, an welchen Jobs Sie interessiert sind.'); ?></li>
		    	<li><?php echo Yii::t('app', 'Sie erhalten jetzt automatisch Jobanfragen, die Ihren Bedürfnissen entsprechen und entscheiden selbst, wo und wann Sie arbeiten.'); ?></li>
		    </ul>
		</div>
	
		<div class="" style="float: right; width: 48%; padding: 10px;  ">
		    <p style="font-size: 22px"><b><?php echo Yii::t('app', 'Arbeitgeber'); ?></b></p>
		    
		    <ul class="animul animul2">
		    	<li><?php echo Yii::t('app', 'Jobprofil definieren, Einsatz erfassen, Lohn festlegen und Mitarbeitersuche starten.'); ?></li>
		    	<li><?php echo Yii::t('app', 'Job2Job schlägt Ihnen automatisch interessierte und passende Mitarbeiter vor. Jetzt können Sie diese mithilfe des Profils, CVs und der Bewertungen auswählen.'); ?></li>
		    </ul>
		</div>
	
		<div class="clear"></div>
	</div>
	
	<br><br><br><br>
				
				
	<div id="hideanimspace" style="height:110px;">&nbsp;</div>					









	
	
</div>

<?php

/* @var $this yii\web\View */
use yii\helpers\Html;

$this->registerCssFile("@web/web/css/braches.css", [], 'css-braches');
$this->registerCssFile("@web/web/css/imageheader.css", [], 'css-imageheader');

?>

<div class="branch-container">

	<div class="anim-image-header" style="background-image: url(<?=Yii::getAlias('@web')?>/web/images/commercial.jpg); background-size: 100% 190%;">

			<div class="anim-image-title">
				Kaufmännische Mitarbeiter mit Know-how und Praxiserfahrung finden
			</div>
	</div>

	<div class="branch-content">
	    <p>Sie haben hohe Ansprüche an Ihre kaufmännischen Angestellten? Dank <a href="<?php echo Yii::getAlias('@web');?>"><b>Job2Job</b></a> müssen Sie diese nicht zurückschrauben. Wir vermitteln Ihnen bestausgebildetes Personal!</p>
	    <div style="margin-top: 20px">
			<div class="width50 pad-right20"><p>Manche Unternehmensweisheiten sind ebenso einfach wie wahr. Die folgende Aussage fällt in diese Kategorie. Kaufmännische Mitarbeiter halten Ihren Betrieb am Laufen – von der Bürokauffrau zum Sachbearbeiter. Kaufmännische Angestellte müssen also her. Klingt einfach? Fällt in der Praxis aber schwer genug.</p></div>
			<div class="width50 pad-left20"><p>Denn kompetente Mitarbeiter gibt es keineswegs wie Sand am mehr. Das erfährt Ihre Recruiting-Abteilung Tag für Tag im alltäglichen Bewerbungsprozess. Kenntnisse in den wichtigen EDV-Programmen, aktuelles Know-how, Praxiserfahrung, Fremdsprachenkenntnisse und Co: die Wunschliste an Bewerber ist lang. Doch deren Skills sind oft so übersichtlich, dass sie keine Listenform verdienen. Nicht so bei Mitarbeitern, die Ihnen <a href="<?php echo Yii::getAlias('@web');?>"><b>Job2Job</b></a> vermittelt. Wir stellen sicher, dass unsere Arbeitskräfte die Qualifizierungen mitbringen, die Sie für essenziell halten! </p></div>
	    	<div class="clear"></div>
		</div>	   
		<br><br><br>

	</div>



</div>

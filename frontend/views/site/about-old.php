<?php

/* @var $this yii\web\View */

use yii\helpers\Html;

$this->registerJsFile("@web/web/js/about.js", [], 'js-about');
$this->registerCssFile("@web/web/css/about.css", [], 'css-about');

$top = ($isindex) ? 980 : 310;
?>

<div class="site-about">

	<div class="branch-header">
			<img src="<?=Yii::getAlias('@web') ?>/web/images/about3.png" alt="" width="100%">
			<div class="branch-image-title" style="top: <?php echo $top; ?>px">
				<div class="text">Wer wir sind</div>
			</div>
	</div>
	
	<div class="staticpage-desc">
		<p class="first"><b>Job2Job GmbH ist ein bundesweit tätiges Unternehmen für strategische Personalberatung, flexible Arbeitnehmerüberlassung, individuelle Direktsuche und direkte Personalvermittlung.</b></p>
		
		<p class="second">Seit vielen Jahren zeichnet sich unser erfahrenes Experten-Team aus durch Sachkompetenz, gute Netzwerke und Leidenschaft für die Sache:</p> 
	
		<p class="j2jgreentext second">Denn wir bringen zielorientiert die geeigneten Menschen zusammen! Schnell und unkompliziert.</p>
		
		<p class="second">Nutzen Sie unser Potenzial mit folgenden Schwerpunkten</p>
		
		<div>
			
			<ul class="second">
				<li>Gesundheitswesen</li>
				<li>Kaufmännischer Sektor</li>
				<li>Industrie und Handwerk</li>
				<li>Ingenieurwesen und Technik</li>
				<li>Lager und Logistik </li>
				<li>Produktion und Gewerbe</li>
			</ul>
			<br>
			
			<p class="first">Job2Job GmbH ist immer der richtige Ansprechpartner:</p> 
			<p class="first">Für Kleinunternehmen genauso wie für den Mittelstand und Großunternehmen denn bei uns sind zuverlässige Bewerber ohne Ausbildung genauso willkommen, wie ausgebildete Spezialisten und Akademiker.</p>
		</div>
		 
		<?php if($isindex){?>
		<div class="j2jgreentext whoareyou" id="whatwedoquestion"><b>Und wer sind Sie?</b></div>
		<div class="button-container">  &nbsp; <a class="about-button j2jgreenback" ng-click="showWhatWeDo(1)">Arbeitnehmer</a> &nbsp; &nbsp; &nbsp; <a class="about-button j2jgreenback" ng-click="showWhatWeDo(2)">Unternehmer</a></div>
		<div id="whatwedopart1" style="display:none;" ><?php echo $this->render('whatwedo', ['part' => 1]);?></div>
		<div id="whatwedopart2" style="display:none;" ><?php echo $this->render('whatwedo', ['part' => 2]);?></div>
		<?php } ?>
	
	</div>
	
	
</div>

<script>
	var whatwedourl = "<?php echo Yii::getAlias('@web/site/whatwedo'); ?>";
</script>
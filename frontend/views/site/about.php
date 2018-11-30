<?php

/* @var $this yii\web\View */

use yii\helpers\Html;

$this->registerJsFile("@web/web/js/about.js", [], 'js-about');
$this->registerCssFile("@web/web/css/about.css", [], 'css-about');

$top = ($isindex) ? 980 : 310;
?>

<div class="site-about">
	<div class="site-about-container">

    	<div class="about-header">Wer wir sind</div>
    	
    	<p>Job2Job GmbH ist immer der richtige Ansprechpartner:</p>
    	<p>Für Kleinunternehmen genauso wie für den Mittelstand und Großunternehmen denn bei uns sind zuverlässige Bewerber ohne Ausbildung genauso willkommen, wie ausgebildete Spezialisten und Akademiker.</p>
    	<div class="site-about-middle" >
        	<div class="site-about-photo content" >
        		<img alt="" src="<?php echo Yii::getAlias('@web/web/images/j2j_11.jpg'); ?>">
        	</div>
        	<div class="site-about-list content" >
                Nutzen Sie unser Potenzial mit folgenden Schwerpunkten:
                <br><br><br>
                <ul>
                	<li class="anim-1">strategische Personalberatung</li>
                	<li class="anim-2">flexible Arbeitnehmerüberlassung</li>
                	<li class="anim-3">individuelle Direktsuche</li>
                	<li class="anim-4">direkte Personalvermittlung</li>
                </ul>         	
        	</div>
        	<div class="clear"></div>
    	</div>
    	<div class="site-about-bottom">
    		<p>Seit vielen Jahren zeichnet sich unser erfahrenes Experten-Team aus durch Sachkompetenz, gute Netzwerke und Leidenschaft für die Sache:</p>

			<p class="j2jgreentext">Denn wir bringen zielorientiert die geeigneten Menschen zusammen! Schnell und unkompliziert.</p>
    	</div>
	
	
	</div>
</div>

<script>
	var whatwedourl = "<?php echo Yii::getAlias('@web/site/whatwedo'); ?>";
</script>
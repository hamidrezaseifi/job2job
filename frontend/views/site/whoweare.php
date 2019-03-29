<?php

/* @var $this yii\web\View */
use yii\helpers\Html;

$this->registerCssFile("@web/web/css/braches.css", [], 'css-braches');
$this->registerCssFile("@web/web/css/imageheader.css", [], 'css-imageheader');

?>

<div class="branch-container">

	<div class="anim-image-header" style="background-image: url(<?=Yii::getAlias('@web')?>/web/images/gesundheitswesen-gray.jpg);">

			<div class="anim-image-title">
				Wer wir sind
			</div>
	</div>

	<div class="branch-content">
	    <p>Woher bekomme ich <strong>schnell und unbürokratisch zusätzliches Personal</strong> für Auftragsspitzen? Wo finde ich <strong>qualifiziertes Fachpersonal</strong>, das mein Unternehmen langfristig auf die Überholspur bringt? Wie komme ich temporär an echtes <strong>Experten-Know-how</strong> für ein einmaliges Projekt? Wo finde ich neue berufliche Herausforderungen? Wie kann ich mir als Arbeitnehmer größtmögliche Flexibilität sichern? </p>
		
	    <div style="margin-top: 20px">
    		<div class="width50 pad-right20"><p>Fünf Fragen, eine Antwort. <a href="<?php echo Yii::getAlias('@web');?>"><b>Job2Job</b></a>. </p></div>
    		<div class="width50 pad-left20"><p>Als langjähriger <strong>Personaldienstleister mit verzweigtem Netzwerk</strong> bringen wir motivierte Mitarbeiter und Unternehmen zusammen. Schnell, unkompliziert und zielorientiert. Das gilt für kleine Betriebe ebenso wie für Mittelstandsunternehmen und Großkonzerne.</p></div>
    		<div class="clear"></div>
 		</div>
		
   		<p>Aus Erfahrung wissen Sie, dass sich Aushilfskräfte in kritischen Momenten gerne ebenso rar machen wie ausgebildete Spezialisten und Akademiker? Dann sprechen Sie uns an und nutzen Sie unser Potenzial mit den Schwerpunkten:</p>
		
		<div class="box-list">
            <div class="item short">strategische Personalberatung,</div> 
            <div class="item short">flexible Arbeitnehmerüberlassung, </div>
            <div class="item short">individuelle Direktsuche </div> 
            <div class="item short">direkte Personalvermittlung.</div> 
            <div class="clear"></div>
		</div>

		<br>
		<p>Die <a href="<?php echo Yii::getAlias('@web');?>"><b>Job2Job</b></a> GmbH hat die Lösung für Ihre Personalengpässe. </p>
		<br>


	</div>



</div>

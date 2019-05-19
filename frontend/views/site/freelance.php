<?php

/* @var $this yii\web\View */
use yii\helpers\Html;

$this->registerCssFile("@web/web/css/braches.css", [], 'css-braches');
$this->registerCssFile("@web/web/css/imageheader.css", [], 'css-imageheader');

?>

<div class="branch-container">

	<div class="anim-image-header" style="background-image: url(<?=Yii::getAlias('@web')?>/web/images/freelance.jpg); background-size: 100vw;">

			<div class="anim-image-title">
				Warum eigentlich... <br>Zeitarbeit? 
			</div>
	</div>

	<div class="branch-content">
	    
	    <div style="margin-top: 20px">
			<div class="width50 pad-left20"><p>Hätten Sie es gewusst? Zeitarbeit kann Ihnen ganz neue Perspektiven eröffnen. <a href="<?php echo Yii::getAlias('@web');?>"><b>Job2Job</b></a> macht es möglich. </p></div>
			<div class="width50 pad-right20"><p>Zugegeben. Zeitarbeit hat nicht unbedingt den besten Ruf. Doch die sogenannte „Arbeitnehmerüberlassung“ hat für Angestellte durchaus auch Vorteile: </p></div>
			<div class="clear"></div>
		</div>

		<div class="box-list">
			<div class="item">Als Berufsanfänger sammeln Sie wertvolle Erfahrungen, die Ihnen den Eintritt in die Arbeitswelt erleichtern. </div>
            <div class="item">Nach längerer Berufsabstinenz fassen Sie durch Zeitarbeit wieder Fuß auf dem Arbeitsmarkt. </div>
            <div class="item">Gerade älteren Arbeitssuchenden winken mit dem Zeitarbeitsmodell neue Perspektiven. </div>
            <div class="item">Eine berufliche Umorientierung wird durch temporäre Arbeitsleistungen vereinfacht. </div>
            <div class="item">Die Arbeitnehmerüberlassung ist in der Regel sozialversicherungspflichtig.</div>
            <div class="item">Zeitarbeitnehmer haben dieselben Rechte wie regulär angestellte Arbeitnehmer. </div>
            <div class="item">Sie wahren sich ein Höchstmaß an Flexibilität.</div>
			<div class="clear"></div>
		</div>
		
		<br>
		<p>Sie möchten mehr über das Modell der Zeitarbeit erfahren? Sprechen Sie uns an. Wir beantworten Ihre Fragen. </p>

		<br>


	</div>



</div>

<?php

/* @var $this yii\web\View */
use yii\helpers\Html;

$this->registerCssFile("@web/web/css/braches.css", [], 'css-braches');
$this->registerCssFile("@web/web/css/imageheader.css", [], 'css-imageheader');

?>

<div class="branch-container">

	<div class="anim-image-header" style="background-image: url(<?=Yii::getAlias('@web')?>/web/images/engineering.jpg); background-size: 100vw calc(100vw * 0.33);">

			<div class="anim-image-title">
				Mit Job2Job die besten Techniker und Ingenieure anwerben 
			</div>
	</div>

	<div class="branch-content">
	    <p>Ingenieure und Techniker sind das Rückgrat vieler Unternehmen. Ohne sie sieht die Zukunft düster aus. <a href="<?php echo Yii::getAlias('@web');?>"><b>Job2Job</b></a> vermittelt Ihnen die qualifizierten Mitarbeiter, die Sie so dringend brauchen!</p>
	    <div style="margin-top: 20px">
			<div class="width50 pad-right20"><p>„Digitale Transformation“. „Industrie 4.0“. „Big Data“. In den Chefetagen surren die Schlagwörter geradezu durch die Luft. Doch ohne technische Experten bleiben sie leere Worthülsen. Das beste Digitalkonzept verläuft sich im Sande, wenn es an qualifizierten Ingenieuren und Technikern mangelt, die die ambitionierten Pläne umsetzen können. Das weiß Ihre Konkurrenz ebenso gut wie Sie. </p></div>
			<div class="width50 pad-left20"><p>Aber Sie haben im Kampf um die besten Techniker und Ingenieure einen Joker in der Hinterhand: <a href="<?php echo Yii::getAlias('@web');?>"><b>Job2Job</b></a>! Dank unserem weit verzweigten Experten-Netzwerk machen wir die passenden Mitarbeiter im Bereich Ingenieurwesen und Technik für Sie ausfindig. Kontaktieren Sie uns – und wir verraten Ihnen, wie! </p></div>
	    	<div class="clear"></div>
		</div>

		<br><br><br>

	</div>



</div>

<?php

/* @var $this yii\web\View */
use yii\helpers\Html;

$this->registerCssFile("@web/web/css/braches.css", [], 'css-braches');
$this->registerCssFile("@web/web/css/imageheader.css", [], 'css-imageheader');

?>

<div class="branch-container">

	<div class="anim-image-header" style="background-image: url(<?=Yii::getAlias('@web')?>/web/images/whyjob2job.jpg); background-size: 100vw;">

			<div class="anim-image-title">
				Warum Job2Job? 
			</div>
	</div>

	<div class="branch-content margintop-minus40">
	    <p>Maue Jobausbeute trotz monatelangem Bewerbungsstress? Meilenweit vom Traumjob entfernt? Mangelnde Flexibilität im Job? Maximaler Einsatz, minimales Gehalt? Schluss damit! Geben Sie die Jobsuche in professionelle Hände.</p>
	    <p><strong> Bei <a href="<?php echo Yii::getAlias('@web');?>"><b>Job2Job</b></a> sind Sie richtig, weil...</strong></p> 

		<p style="border: 1px solid gray; margin: 20px 0; padding: 8px; text-align: center;"> bei uns immer Sie im Mittelpunkt stehen. <a href="<?php echo Yii::getAlias('@web');?>"><b>Job2Job</b></a> betreut Sie über den gesamten Bewerbungsprozess hindurch und darüber hinaus.</p>
		<p style="border: 1px solid gray; margin: 20px 0; padding: 8px; text-align: center;"> Sie sich ruhig auch mal auf Ihren Lorbeeren ausruhen dürfen. Sie haben die Ausbildung, wir den passenden Job.</p>
		<p style="border: 1px solid gray; margin: 20px 0; padding: 8px; text-align: center;"> Sie sicherlich nicht gerne in die berufliche Sackgasse steuern. <a href="<?php echo Yii::getAlias('@web');?>"><b>Job2Job</b></a> reißt das Ruder herum und verschafft Ihnen neue Perspektiven.</p>
		<p style="border: 1px solid gray; margin: 20px 0; padding: 8px; text-align: center;"> wir in vielen Branchen bestens vernetzt sind. Damit haben Sie bei Ihrem potenziellen Arbeitgeber gleich ein Stein im Brett – und beste Chancen auf eine Anstellung in Ihrem Traumjob. </p>
		<p style="border: 1px solid gray; margin: 20px 0; padding: 8px; text-align: center;"> bei uns immer Sie der Boss sind. Sie entscheiden wo, wann und wie viel Sie arbeiten möchten – wir kümmern uns um den Rest. </p>
		<div class="clear"></div>
		<br>
		<p><a href="<?php echo Yii::getAlias('@web');?>"><b>Job2Job</b></a> – weil Sie sich nicht mit weniger zufrieden geben möchten!</p>
		
		<br>


	</div>



</div>

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

	<div class="branch-content">
	    <p>Maue Jobausbeute trotz monatelangem Bewerbungsstress? Meilenweit vom Traumjob entfernt? Mangelnde Flexibilität im Job? Maximaler Einsatz, minimales Gehalt? Schluss damit! Geben Sie die Jobsuche in professionelle Hände. Bei <a href="<?php echo Yii::getAlias('@web');?>"><b>Job2Job</b></a> sind Sie richtig, weil...</p> 

		<div class="box-list">
			<div class="item"> bei uns immer Sie im Mittelpunkt stehen. <a href="<?php echo Yii::getAlias('@web');?>"><b>Job2Job</b></a> betreut Sie über den gesamten Bewerbungsprozess hindurch und darüber hinaus.</div>
			<div class="item"> Sie sich ruhig auch mal auf Ihren Lorbeeren ausruhen dürfen. Sie haben die Ausbildung, wir den passenden Job.</div>
			<div class="item"> Sie sicherlich nicht gerne in die berufliche Sackgasse steuern. <a href="<?php echo Yii::getAlias('@web');?>"><b>Job2Job</b></a> reißt das Ruder herum und verschafft Ihnen neue Perspektiven.</div>
			<div class="item"> wir in vielen Branchen bestens vernetzt sind. Damit haben Sie bei Ihrem potenziellen Arbeitgeber gleich ein Stein im Brett – und beste Chancen auf eine Anstellung in Ihrem Traumjob. </div>
			<div class="item"> bei uns immer Sie der Boss sind. Sie entscheiden wo, wann und wie viel Sie arbeiten möchten – wir kümmern uns um den Rest. </div>
		</div>
		<div class="clear"></div>
		<br>
		<p><a href="<?php echo Yii::getAlias('@web');?>"><b>Job2Job</b></a> – weil Sie sich nicht mit weniger zufrieden geben möchten!</p>
		
		<br>


	</div>



</div>

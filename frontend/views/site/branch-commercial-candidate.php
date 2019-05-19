<?php

/* @var $this yii\web\View */
/* @var $shortCut string */
/* @var $jobModels array */
use yii\helpers\Html;

$this->registerCssFile("@web/web/css/braches.css", [], 'css-braches');
$this->registerCssFile("@web/web/css/imageheader.css", [], 'css-imageheader');

?>

<div class="branch-container">

	<div class="anim-image-header" style="background-image: url(<?=Yii::getAlias('@web')?>/web/images/commercial2.jpg); background-size: 100vw calc(100vw * 0.33);">

			<div class="anim-image-title">
				Arbeiten im kaufmännischen Sektor:<br>
				ohne Bewerbungsstress

			</div>
	</div>

	<div class="branch-content">
	    <p>Im kaufmännischen Sektor stehen Ihre Chancen auf einen Arbeitsplatz gut. Doch die Suche nach der geeigneten Stelle ist mühsam. <a href="<?php echo Yii::getAlias('@web');?>"><b>Job2Job</b></a> nimmt Sie Ihnen ab!</p>
	    <div style="margin-top: 20px">
	    	<div class="width50 pad-right20"><p>Sie sind gelernter Bürokaufmann/-kauffrau, Sachbearbeiter/in oder arbeiten in einem anderen Beruf im kaufmännischen Bereich? Herzlichen Glückwunsch. Sie haben prinzipiell die Möglichkeit in nahezu jedem deutschen Unternehmen zu arbeiten. Doch eine große Auswahl macht auch den Bewerbungsprozess mühsam. Zumal auf attraktive Stellen in renommierten Unternehmen ein regelrechter Run herrscht.</p></div>
	    	<div class="width50 pad-left20"><p>Diesen Bewerbungsstress möchten Sie sich am liebsten vom Hals halten? Dann beauftragen Sie <a href="<?php echo Yii::getAlias('@web');?>"><b>Job2Job</b></a> damit – und lehnen Sie sich entspannt zurück. Wir finden den Arbeitgeber, bei dem Sie glücklich werden – auch in finanzieller Hinsicht. Ganz egal, ob Sie eine Festanstellung suchen oder für flexible Einsätze offen sind.</p></div>
	    	<div class="clear"></div>
	    </div>
		
		

		<div class="box-list">
			<div class="item"><div><b>Jobs von <a href="<?php echo Yii::getAlias('@web');?>"><b>Job2Job</b></a></b></div> Riesige Auswahl, minimaler Aufwand – Ihr Job findet Sie.</div>
			<div class="item"><div><b>Faire Löhne</b></div> Verkaufen Sie sich nicht unter Wert. Die Einhaltung aller Mindestlöhne und zusätzlichen Vergütungen hat für uns oberste Priorität. </div>
			<div class="item"><div><b>Flexibel 1-100% arbeiten</b></div> Leben und Arbeiten Sie nach Ihren Regeln – individuell und selbstbestimmt. </div>
		</div>
		<div class="clear"></div>

		<br><br><br>

	</div>

    <?php echo $this->render('blue-jobposition-list', [
        'jobModels' => $jobModels,
        'showSearch' => false, 
        'showMoreFromBranch' => true, 
        'forTitle' => 'FÜR kaufmännischen Sektor',
        'shortCut' => $shortCut,
        
    ]);
    ?>



</div>

<?php

/* @var $this yii\web\View */
/* @var $shortCut string */
/* @var $jobModels array */
use yii\helpers\Html;

$this->registerCssFile("@web/web/css/braches.css", [], 'css-braches');
$this->registerCssFile("@web/web/css/imageheader.css", [], 'css-imageheader');

?>

<div class="branch-container">

	<div class="anim-image-header" style="background-image: url(<?=Yii::getAlias('@web')?>/web/images/gesundheitswesen-gray.jpg);">

			<div class="anim-image-title">
				Arbeiten im kaufmännischen Sektor:<br>
				ohne Bewerbungsstress

			</div>
	</div>

	<div class="branch-content">
	    <p><b>Im kaufmännischen Sektor stehen Ihre Chancen auf einen Arbeitsplatz gut. Doch die Suche nach der geeigneten Stelle ist mühsam. Job2Job nimmt Sie Ihnen ab!</b></p>
		<p>Sie sind gelernter Bürokaufmann/-kauffrau, Sachbearbeiter/in oder arbeiten in einem anderen Beruf im kaufmännischen Bereich? Herzlichen Glückwunsch. Sie haben prinzipiell die Möglichkeit in nahezu jedem deutschen Unternehmen zu arbeiten. Doch eine große Auswahl macht auch den Bewerbungsprozess mühsam. Zumal auf attraktive Stellen in renommierten Unternehmen ein regelrechter Run herrscht.</p>
		<p>Diesen Bewerbungsstress möchten Sie sich am liebsten vom Hals halten? Dann beauftragen Sie Job2Job damit – und lehnen Sie sich entspannt zurück. Wir finden den Arbeitgeber, bei dem Sie glücklich werden – auch in finanzieller Hinsicht. Ganz egal, ob Sie eine Festanstellung suchen oder für flexible Einsätze offen sind.</p>

		<ul>
			<li><b>Jobe von Job2Job :</b> Riesige Auswahl, minimaler Aufwand – Ihr Job findet Sie.</li>
			<li><b>Faire Löhne:</b> Verkaufen Sie sich nicht unter Wert. Die Einhaltung aller Mindestlöhne und zusätzlichen Vergütungen hat für uns oberste Priorität. </li>
			<li><b>Flexibel 1-100% arbeiten:</b> Leben und Arbeiten Sie nach Ihren Regeln – individuell und selbstbestimmt. </li>
		</ul>

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

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
				Ingenieurwesen und Technik :<br>
				Jobs mit Zukunft?
			</div>
	</div>

	<div class="branch-content">
	    <p>Als Ingenieur oder Techniker sind Sie hochqualifiziert. Job2Job sorgt dafür, dass sich das auch in Ihrer Position niederschlägt – ebenso wie in Ihrem Gehalt!  </p>
	    <div>
    		<div class="width50 pad20"><p>Egal, ob Bauingenieur, Elektrotechniker, Maschinenbauer oder Werkstofftechniker: Als Absolvent eines technischen Berufs gestalten Sie jeden Tag die Zukunft unseres Landes ein Stückchen mit – und die der ganzen Welt. Aber wie sieht es eigentlich mit Ihrer eigenen (beruflichen) Zukunft aus? Arbeiten Sie in Ihrer Wunschposition? Eröffnet Ihnen Ihr Arbeitgeber neben fachlichen auch karrieretechnische Entwicklungsmöglichkeiten? Genießen Sie alle Freiheiten, die es braucht, um Beruf und Karriere unter einen Hut zu bekommen?</p></div>
    		<div class="width50 pad20"><p>Nein? Dann wird es Zeit, etwas zu ändern. Job2Job hilft Ihnen beim Finden eines Arbeitgebers, der Ihren persönlichen Wünschen entgegenkommt. Bauen Sie auf Ihre Top-Qualifikation und geben Sie sich nicht mit weniger zufrieden!  </p></div>
	    	<div class="clear"></div>
		</div>

		<div class="box-list">
			<div class="item"><div><b>Jobs von Job2Job</b></div> Riesige Auswahl, minimaler Aufwand – Ihr Job findet Sie.</div>
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
        'forTitle' => 'FÜR Ingenieurwesen und Technik',
        'shortCut' => $shortCut,
        
    ]);
    ?>


</div>

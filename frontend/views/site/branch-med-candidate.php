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
				Jobs im Gesundheitswesen:<br>
				Einfach finden lassen, wertgeschätzt arbeiten

			</div>
	</div>

	<div class="branch-content">
	    <p><b>Es ist kein Geheimnis: Qualifizierte Pflegekräfte werden händeringend gesucht. Kein Beruf ist in unserer alternden Gesellschaft wichtiger. Job2Job vermittelt Sie an die Arbeitgeber, die Ihre Arbeit zu schätzen wissen.</b></p>
	    <div>
			<div class="width50 pad20"><p>Egal, ob Sie Gesundheits- und Krankenpfleger/in, examinierter Altenpfleger/in oder Pflegeassistent sind: Als Teil der stark wachsenden Gesundheitsbranche sind Sie unverzichtbar. Das verdient Wertschätzung. Job2Job findet auf Basis Ihrer persönlichen Wünsche und Vorstellungen die Anstellung, in der Sie sich wirklich wohlfühlen. </p></div>
			<div class="width50 pad20"><p>Arbeiten Sie Teilzeit, Vollzeit oder wahren Sie Ihre Flexibilität mit gelegentlichen Einsätzen. Pensionierte Fachkräfte, sind dabei ebenso gesucht wie Quereinsteiger. Nutzen Sie die Gelegenheit und setzen Sie Ihre Arbeitskraft zum Wohl unserer Gesellschaft ein – zu fairen Konditionen versteht sich.</p></div>
	    	<div class="clear"></div>
		</div>

		<div class="box-list">
			<div class="item"><div><b>Jobe von Job2Job :</b></div> Riesige Auswahl, minimaler Aufwand – Ihr Job findet Sie.</div>
			<div class="item"><div><b>Faire Löhne:</b></div> Verkaufen Sie sich nicht unter Wert. Die Einhaltung aller Mindestlöhne und zusätzlichen Vergütungen hat für uns oberste Priorität. </div>
			<div class="item"><div><b>Flexibel 1-100% arbeiten:</b></div> Leben und Arbeiten Sie nach Ihren Regeln – individuell und selbstbestimmt. </div>
		</div>
		<div class="clear"></div>

		<br><br><br>

	</div>

    <?php echo $this->render('blue-jobposition-list', [
        'jobModels' => $jobModels,
        'showSearch' => false, 
        'showMoreFromBranch' => true, 
        'forTitle' => 'FÜR Gesundheitswesen',
        'shortCut' => $shortCut,
        
    ]);
    ?>


</div>

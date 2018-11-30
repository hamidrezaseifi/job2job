<?php

/* @var $this yii\web\View */
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
		<p>Egal, ob Sie Gesundheits- und Krankenpfleger/in, examinierter Altenpfleger/in oder Pflegeassistent sind: Als Teil der stark wachsenden Gesundheitsbranche sind Sie unverzichtbar. Das verdient Wertschätzung. Job2Job findet auf Basis Ihrer persönlichen Wünsche und Vorstellungen die Anstellung, in der Sie sich wirklich wohlfühlen. Arbeiten Sie Teilzeit, Vollzeit oder wahren Sie Ihre Flexibilität mit gelegentlichen Einsätzen. Pensionierte Fachkräfte, sind dabei ebenso gesucht wie Quereinsteiger. Nutzen Sie die Gelegenheit und setzen Sie Ihre Arbeitskraft zum Wohl unserer Gesellschaft ein – zu fairen Konditionen versteht sich.</p>

		<ul>
			<li><b>Jobe von Job2Job :</b> Riesige Auswahl, minimaler Aufwand – Ihr Job findet Sie.</li>
			<li><b>Faire Löhne:</b> Verkaufen Sie sich nicht unter Wert. Die Einhaltung aller Mindestlöhne und zusätzlichen Vergütungen hat für uns oberste Priorität. </li>
			<li><b>Flexibel 1-100% arbeiten:</b> Leben und Arbeiten Sie nach Ihren Regeln – individuell und selbstbestimmt. </li>
		</ul>

		<br><br><br>
		<div>
			<div style="float: left;">
				<?php

if (count($jobModels) > 0) {
        ?>
				<p><b>Verfügbare Jobprofile bei Job2Job </b></p>
				<ul>
					<?php

foreach ($jobModels as $jobModel) {
            ?>
					<li><?php

echo $jobModel->title;
            ?> </li>
					<?php

}
        ?>
					<li><a href="javascript:void()">Und mehr</a></li>
				</ul>
				<?php

} else {
        ?>
				<p><b>Zurzeot gibt keine verfügbare Jobprofile bei Job2Job im Gesundheitswesen </b></p>
				<?php

}
    ?>
			</div>
			<div class="clear"></div>
		</div>
		<br><br><br>


	</div>



</div>

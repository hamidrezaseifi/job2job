<?php

/* @var $this yii\web\View */
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
	    <p><b>Als Ingenieur oder Techniker sind Sie hochqualifiziert. Job2Job sorgt dafür, dass sich das auch in Ihrer Position niederschlägt – ebenso wie in Ihrem Gehalt!  </b></p>
		<p>Egal, ob Bauingenieur, Elektrotechniker, Maschinenbauer oder Werkstofftechniker: Als Absolvent eines technischen Berufs gestalten Sie jeden Tag die Zukunft unseres Landes ein Stückchen mit – und die der ganzen Welt. Aber wie sieht es eigentlich mit Ihrer eigenen (beruflichen) Zukunft aus? Arbeiten Sie in Ihrer Wunschposition? Eröffnet Ihnen Ihr Arbeitgeber neben fachlichen auch karrieretechnische Entwicklungsmöglichkeiten? Genießen Sie alle Freiheiten, die es braucht, um Beruf und Karriere unter einen Hut zu bekommen?</p>
		<p>Nein? Dann wird es Zeit, etwas zu ändern. Job2Job hilft Ihnen beim Finden eines Arbeitgebers, der Ihren persönlichen Wünschen entgegenkommt. Bauen Sie auf Ihre Top-Qualifikation und geben Sie sich nicht mit weniger zufrieden!  </p>

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
				<p><b>Zurzeot gibt keine verfügbare Jobprofile bei Job2Job im Ingenieurwesen und Technik </b></p>
				<?php

}
    ?>
			</div>
			<div class="clear"></div>
		</div>
		<br><br><br>


	</div>



</div>

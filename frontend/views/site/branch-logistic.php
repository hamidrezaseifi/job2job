<?php

/* @var $this yii\web\View */
use yii\helpers\Html;

$this->registerCssFile("@web/web/css/braches.css", [], 'css-braches');
$this->registerCssFile("@web/web/css/imageheader.css", [], 'css-imageheader');

?>

<div class="branch-container">

	<div class="anim-image-header" style="background-image: url(<?=Yii::getAlias('@web')?>/web/images/gesundheitswesen-gray.jpg);">

			<div class="anim-image-title">
				Jobs in Lager und Logistik:<br>
				faire Löhne, gute Arbeitsbedingungen
			</div>
	</div>

	<div class="branch-content">
	    <p><b>Angestellte und temporäre Hilfskräfte in Lager und Logistik werden händeringend gesucht. Doch die Arbeitsbedingungen sind nicht überall gut. Mit Job2Job finden Sie die Stellen, bei denen Arbeit noch Spaß macht!</b></p>
		<p>Der Online-Handel boomt. Die unvermeidliche Folge: beständig wachsende Lager und eine wahre Paket-Flut, die sich – gerade zur Weihnachtszeit – zu immer höheren Wellen auftürmt. Wellen schlagen in jüngster Zeit auch die mitunter prekären Verhältnisse von (Zeit-)Arbeitskräften in Lager und Logistik.</p>
		<p>Haben Sie genug von Lohn-Dumping, unbezahlten Überstunden und Leistungsdruck? Dann wenden Sie sich an Job2Job. Unser Versprechen:</p>

		<ul>
			<li><b>Faire Löhne :</b> Einhaltung von Mindestlöhnen und zusätzliche Vergütungen bei Mehrarbeit.</li>
			<li><b>Minimaler Aufwand :</b> Sie lehnen sich zurück, wir kümmern uns .</li>
			<li><b>Flexibles Arbeitsmodell :</b> Sie entscheiden, wie viel Sie arbeiten.</li>
		</ul>

		<p>Sie haben Erfahrung im Bereich Lager und Logistik? Dann kontaktieren Sie uns. Wir finden gemeinsam mit Ihnen den Arbeitgeber, der Ihre unverzichtbare Arbeit zu schätzen weiß.</p>

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
				<p><b>Zurzeot gibt keine verfügbare Jobprofile bei Job2Job im Lager und Logistik</b></p>
				<?php

}
    ?>
			</div>
			<div class="clear"></div>
		</div>
		<br><br><br>


	</div>



</div>

<?php

/* @var $this yii\web\View */
use yii\helpers\Html;

$this->registerCssFile("@web/web/css/braches.css", [], 'css-braches');
$this->registerCssFile("@web/web/css/imageheader.css", [], 'css-imageheader');

?>

<div class="branch-container">

	<div class="anim-image-header" style="background-image: url(<?=Yii::getAlias('@web')?>/web/images/gesundheitswesen-gray.jpg);">

			<div class="anim-image-title">
				Aushilfskräfte für Produktion und Gewerbe
			</div>
	</div>

	<div class="branch-content">
	    <p><strong>Hilfskräftemangel in Produktion und Gewerbe? Das muss nicht sein. Job2Job sorgt dafür, dass aus dem temporären Bedarf an Aushilfskräften kein Dauerzustand wird. </strong></p>
		<p>Das Lager platzt aus allen Nähten. Zugleich verzögert der Mangel an Helfern den Produktionsprozess. Umso größer fällt die Arbeitslast der Angestellten aus – Fehler und Qualitätseinbußen sind die Folge. Kommen Ihnen Szenarien wie diese bekannt vor? Dann verlieren Sie keine Zeit und kontaktieren Sie uns! </p>
		<p>Job2Job vermittelt Ihnen zuverlässige Mitarbeiter für die Festanstellung oder flexible Zeitarbeitskräfte für Ihren Produktionsbetrieb oder Ihr Gewerbe – vom Lagerarbeiter über den Produktionshelfer bis hin zur Aushilfskraft bei der Qualitätsprüfung. Schnell und unbürokratisch versteht sich. </p>

		<br>
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
				<p><b>Zurzeot gibt keine verfügbare Jobprofile bei Job2Job im Produktion und Gewerbe</b></p>
				<?php

}
    ?>
			</div>
			<div class="clear"></div>
		</div>
		<br><br><br>


	</div>



</div>

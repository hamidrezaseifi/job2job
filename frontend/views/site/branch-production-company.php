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
	    <p>Hilfskräftemangel in Produktion und Gewerbe? Das muss nicht sein. <a href="<?php echo Yii::getAlias('@web');?>"><b>Job2Job</b></a> sorgt dafür, dass aus dem temporären Bedarf an Aushilfskräften kein Dauerzustand wird. </p>
	    <div style="margin-top: 20px">
			<div class="width50 pad-right20"><p>Das Lager platzt aus allen Nähten. Zugleich verzögert der Mangel an Helfern den Produktionsprozess. Umso größer fällt die Arbeitslast der Angestellten aus – Fehler und Qualitätseinbußen sind die Folge. Kommen Ihnen Szenarien wie diese bekannt vor? Dann verlieren Sie keine Zeit und kontaktieren Sie uns! </p></div>
			<div class="width50 pad-left20"><p><a href="<?php echo Yii::getAlias('@web');?>"><b>Job2Job</b></a> vermittelt Ihnen zuverlässige Mitarbeiter für die Festanstellung oder flexible Zeitarbeitskräfte für Ihren Produktionsbetrieb oder Ihr Gewerbe – vom Lagerarbeiter über den Produktionshelfer bis hin zur Aushilfskraft bei der Qualitätsprüfung. Schnell und unbürokratisch versteht sich. </p></div>
	    	<div class="clear"></div>
		</div>

		<br><br><br>

	</div>

</div>

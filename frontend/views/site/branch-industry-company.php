<?php

/* @var $this yii\web\View */
use yii\helpers\Html;

$this->registerCssFile("@web/web/css/braches.css", [], 'css-braches');
$this->registerCssFile("@web/web/css/imageheader.css", [], 'css-imageheader');

?>

<div class="branch-container">

	<div class="anim-image-header" style="background-image: url(<?=Yii::getAlias('@web')?>/web/images/industrie.jpg); background-size: 100% 156%;">

			<div class="anim-image-title">
				Industrie und Handwerk:<br>
				Know-how ist essenziell, aber rar gesät
			</div>
	</div>

	<div class="branch-content">
	    <p>Mitarbeiter mit fachlichem Know-how sind in Industrie und Handwerk unabdingbar. <a href="<?php echo Yii::getAlias('@web');?>"><b>Job2Job</b></a> unterstützt Sie bei der Suche nach den geeigneten Arbeitskräften.</p>
	    <div style="margin-top: 20px">
			<div class="width50 pad-right20"><p>Zwei Stunden Produktionsstopp in Folge einer unzureichend gewarteten Maschine: 78.000 Euro Verdienstausfall. Laxes Qualitätsmanagement beim Design eines neuen Produkts: 12.000 Euro in nicht umsetzbare technische Zeichnungen investiert. Ein falscher Handgriff im Labor: Die komplette Charge im Wert von 21.000 Euro ist hinüber. In Industrie und Handwerk können Fehler teuer werden. Richtig teuer. </p></div>
			<div class="width50 pad-left20"><p>Das wissen Sie als Unternehmer oder leitender Angestellter nur zu gut. Umso mehr Wert legen Sie auf fachliches Know-how, Sorgfalt und eine gute Ausbildung Ihrer Mitarbeiter. Ihr hoher Qualitätsanspruch macht die Bewerberauswahl schwierig und Ihrer HR-Abteilung das Leben schwer? Dann überlassen Sie diese <a href="<?php echo Yii::getAlias('@web');?>"><b>Job2Job</b></a>! Wir arbeiten mit qualifizierten Facharbeitern aus Industrie und Handwerk zusammen – und stellen Ihnen diese gerne vor. </p></div>
	    	<div class="clear"></div>
		</div>
		
		<br><br><br>

	</div>

</div>

<?php

/* @var $this yii\web\View */
use yii\helpers\Html;

$this->registerCssFile("@web/web/css/braches.css", [], 'css-braches');
$this->registerCssFile("@web/web/css/imageheader.css", [], 'css-imageheader');

?>

<div class="branch-container">

	<div class="anim-image-header" style="background-image: url(<?=Yii::getAlias('@web')?>/web/images/med-branche.jpg); background-size: 100% 100%;">

			<div class="anim-image-title">
				Gesundheitswesen:<br>
				Endlich qualifiziertes Fachpersonal finden lassen

			</div>
	</div>

	<div class="branch-content">
	    <p>Gerade in der Gesundheitsbranche ist qualifiziertes Personal schwer zu finden. Dabei wird es dringendst gebraucht, um den Betrieb am Laufen zu halten. <a href="<?php echo Yii::getAlias('@web');?>"><b>Job2Job</b></a> vermittelt Ihnen die passenden Bewerber!</p>
	    <div style="margin-top: 20px">
			<div class="width50 pad-right20"><p>Sie sind im Management eines Krankenhauses, Altenheims oder einer Pflegeeinrichtung tätig? Dann fühlen Sie sich mitunter sicherlich als Protagonist/in eines absurden Theaterstücks. Sie warten tage-, wochen- und monatelang auf qualifizierte Bewerber, doch die Suche bleibt ergebnislos. Mit jedem Tag, der verstreicht, schwindet nicht nur Ihre Hoffnung, auch die Lage Ihrer Mitarbeiter spitzt sich weiter zu. Vermutlich kennen Sie die nun einsetzende Spirale allzu gut. Ein Mangel an Fachkräften führt zu</p></div>
			<div class="width50 pad-left20"><p>Es liegt an Ihnen. Durchbrechen Sie diesen Teufelskreis, bevor es zu spät ist. Mit der Hilfe von <a href="<?php echo Yii::getAlias('@web');?>"><b>Job2Job</b></a>! Aus unserem riesigen Netzwerk an qualifiziertem Pflegepersonal vermitteln wir Ihnen, die Arbeitskräfte die Sie so händeringend suchen. Bauen Sie auf unser top ausgebildetes Personal – und machen Sie dem Warten auf Godot ein Ende. </p></div>
	    	<div class="clear"></div>
		</div>
		

		<div class="box-list">
			<div class="item short">zusätzlichen Überstunden für die Belegschaft führen zu </div>
            <div class="item short">Personal, das sich zusehends an der Belastungsgrenze bewegt führt zu </div>
            <div class="item short">häufigeren Krankheitstagen führen zu </div>
            <div class="item short">noch mehr Überstunden für das anwesende Personal führen zu </div>
            <div class="item short">langen Ausfallzeiten, Burnouts und Kündigungen führen zu </div>
            <div class="item short">einem noch stärkeren Personalbedarf. </div>
	    	<div class="clear"></div>
		</div>		

		<br><br><br>


	</div>



</div>

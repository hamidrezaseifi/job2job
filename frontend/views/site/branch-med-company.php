<?php

/* @var $this yii\web\View */
use yii\helpers\Html;

$this->registerCssFile("@web/web/css/braches.css", [], 'css-braches');
$this->registerCssFile("@web/web/css/imageheader.css", [], 'css-imageheader');

?>

<div class="branch-container">

	<div class="anim-image-header" style="background-image: url(<?=Yii::getAlias('@web')?>/web/images/gesundheitswesen-gray.jpg);">

			<div class="anim-image-title">
				Gesundheitswesen:<br>
				Endlich qualifiziertes Fachpersonal finden lassen

			</div>
	</div>

	<div class="branch-content">
	    <p><strong>Gerade in der Gesundheitsbranche ist qualifiziertes Personal schwer zu finden. Dabei wird es dringendst gebraucht, um den Betrieb am Laufen zu halten. Job2Job vermittelt Ihnen die passenden Bewerber!</strong></p>
		<p>Sie sind im Management eines Krankenhauses, Altenheims oder einer Pflegeeinrichtung tätig? Dann fühlen Sie sich mitunter sicherlich als Protagonist/in eines absurden Theaterstücks. Sie warten tage-, wochen- und monatelang auf qualifizierte Bewerber, doch die Suche bleibt ergebnislos. Mit jedem Tag, der verstreicht, schwindet nicht nur Ihre Hoffnung, auch die Lage Ihrer Mitarbeiter spitzt sich weiter zu. Vermutlich kennen Sie die nun einsetzende Spirale allzu gut. Ein Mangel an Fachkräften führt zu</p>

		<ul>
			<li>zusätzlichen Überstunden für die Belegschaft führen zu </li>
            <li>Personal, das sich zusehends an der Belastungsgrenze bewegt führt zu </li>
            <li>häufigeren Krankheitstagen führen zu </li>
            <li>noch mehr Überstunden für das anwesende Personal führen zu </li>
            <li>langen Ausfallzeiten, Burnouts und Kündigungen führen zu </li>
            <li>einem noch stärkeren Personalbedarf. </li>

		</ul>
		<br>
		<p>Es liegt an Ihnen. Durchbrechen Sie diesen Teufelskreis, bevor es zu spät ist. Mit der Hilfe von Job2Job! Aus unserem riesigen Netzwerk an qualifiziertem Pflegepersonal vermitteln wir Ihnen, die Arbeitskräfte die Sie so händeringend suchen. Bauen Sie auf unser top ausgebildetes Personal – und machen Sie dem Warten auf Godot ein Ende. </p>
		
		<div>
			<div style="float: left;">
				<?php

if (count($jobModels) > 0) {
        ?>
				<p><strong>Verfügbare Jobprofile bei Job2Job </strong></p>
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

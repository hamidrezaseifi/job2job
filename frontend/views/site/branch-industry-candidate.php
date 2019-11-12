<?php

/* @var $this yii\web\View */
/* @var $shortCut string */
/* @var $jobModels array */
use yii\helpers\Html;

$this->registerCssFile("@web/web/css/braches.css", [], 'css-braches');
$this->registerCssFile("@web/web/css/imageheader.css", [], 'css-imageheader');

?>

<div class="branch-container">

	<div class="anim-image-header" style="background-image: url(<?=Yii::getAlias('@web')?>/web/images/industrie.jpg); background-size: 100% 156%;">

			<div class="anim-image-title">
				Jobs in Industrie und Handwerk:<br>
				Lassen Sie sich wertschätzen
			</div>
	</div>

	<div class="branch-content  margintop-80">
	    <p><strong>Handwerker und Industrie-Arbeiter sind fachlich hochqualifiziert, berufliche Perspektive und gute Bezahlung aber sind nicht überall die Regel. <br>Es sei denn <a href="<?php echo Yii::getAlias('@web');?>"><b>Job2Job</b></a> übernimmt die Vermittlung. </strong></p>
	    
	    <p>Vom Schweißer zum Schlosser, vom Maler zum Modellbauer, vom Koch zum Klempner – Industrie und Handwerk bieten vielen hundert Berufen ein Zuhause. Eines haben jedoch alle Angehörigen der Branche gemeinsam: Sie bringen ein erhebliches Maß an fachlichem Know-how mit. Das wird von Arbeitgebern geschätzt – aber nicht immer wertgeschätzt.</p>
	    
	    <p style="border: 1px solid gray; margin: 20px 0; padding: 8px; text-align: center;">Sind Sie es leid, im unterbezahlten „dead end“ Job ohne berufliche Aufstiegschancen zu versauern?</p>

	    <p style="border: 1px solid gray; margin: 20px 0; padding: 8px; text-align: center;">Möchten Sie Ihr mühsam erworbenes Fachwissen in den Dienst einer anspruchsvolleren Aufgabe stellen?</p>

	    <p style="border: 1px solid gray; margin: 20px 0; padding: 8px; text-align: center;">Oder suchen Sie einfach nach einer angemessenen Vergütung für Ihre Fähigkeiten?</p>
	    
	    <p><strong>Dann sprechen Sie uns an! Sie haben die Ambitionen, wir die nötigen Kontakte, um Ihnen eine Stelle mit Zukunft zu verschaffen.</strong></p>
	    	

		<br><br><br>
	</div>

    <?php echo $this->render('blue-jobposition-list', [
        'jobModels' => $jobModels,
        'showSearch' => false, 
        'showMoreFromBranch' => true, 
        'forTitle' => 'FÜR Industrie und Handwerk',
        'shortCut' => $shortCut,
        
    ]);
    ?>



</div>

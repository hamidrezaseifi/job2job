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
				Jobs in Lager und Logistik:<br>
				faire Löhne, gute Arbeitsbedingungen
			</div>
	</div>

	<div class="branch-content">
	    <p><b>Angestellte und temporäre Hilfskräfte in Lager und Logistik werden händeringend gesucht. Doch die Arbeitsbedingungen sind nicht überall gut. Mit Job2Job finden Sie die Stellen, bei denen Arbeit noch Spaß macht!</b></p>
	    <div>
    		<div class="width50 pad20"><p>Der Online-Handel boomt. Die unvermeidliche Folge: beständig wachsende Lager und eine wahre Paket-Flut, die sich – gerade zur Weihnachtszeit – zu immer höheren Wellen auftürmt. Wellen schlagen in jüngster Zeit auch die mitunter prekären Verhältnisse von (Zeit-)Arbeitskräften in Lager und Logistik.</p></div>
    		<div class="width50 pad20"><p>Haben Sie genug von Lohn-Dumping, unbezahlten Überstunden und Leistungsdruck? Dann wenden Sie sich an Job2Job. Unser Versprechen:</p></div>
	    	<div class="clear"></div>
		</div>

		<div class="box-list">
			<div class="item"><div><b>Faire Löhne :</b></div> Einhaltung von Mindestlöhnen und zusätzliche Vergütungen bei Mehrarbeit.</div>
			<div class="item"><div><b>Minimaler Aufwand :</b></div> Sie lehnen sich zurück, wir kümmern uns .</div>
			<div class="item"><div><b>Flexibles Arbeitsmodell :</b></div> Sie entscheiden, wie viel Sie arbeiten.</div>
		</div>
		<div class="clear"></div>

		<p>Sie haben Erfahrung im Bereich Lager und Logistik? Dann kontaktieren Sie uns. Wir finden gemeinsam mit Ihnen den Arbeitgeber, der Ihre unverzichtbare Arbeit zu schätzen weiß.</p>

		<br><br><br>

	</div>

    <?php echo $this->render('blue-jobposition-list', [
        'jobModels' => $jobModels,
        'showSearch' => false, 
        'showMoreFromBranch' => true, 
        'forTitle' => 'FÜR Lager und Logistik',
        'shortCut' => $shortCut,
        
    ]);
    ?>

</div>

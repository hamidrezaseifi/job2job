<?php

/* @var $this yii\web\View */
/* @var $shortCut string */
/* @var $jobModels array */
use yii\helpers\Html;

$this->registerCssFile("@web/web/css/braches.css", [], 'css-braches');
$this->registerCssFile("@web/web/css/imageheader.css", [], 'css-imageheader');

?>

<div class="branch-container">

	<div class="anim-image-header" style="background-image: url(<?=Yii::getAlias('@web')?>/web/images/production.jpg); background-size: 100vw;">

			<div class="anim-image-title">
				Vom Tellerwäscher zum Millionär?<br>
				Jobs in Produktion und Gewerbe
			</div>
	</div>

	<div class="branch-content">
	    <p>
	    	In Produktion und Gewerbe werden immer wieder motivierte Hilfskräfte gesucht. Sie sind auf der Suche nach einer neuen Herausforderung und wollen in unterschiedliche Branchen reinschnuppern? <a href="<?php echo Yii::getAlias('@web');?>"><b>Job2Job</b></a> hilft Ihnen dabei!
	    </p>
	    <div style="margin-top: 20px">
			<div class="width50 pad-right20"><p>Selbst Milliardäre haben mal klein angefangen. Schon aus diesem Grund nehmen Sie das Sprichwort „Vom Tellerwäscher zum Millionär“ gerne wörtlich? Dann sind Sie bei uns richtig. Bewerben Sie sich als Aushilfskraft – beispielsweise als Küchenhilfe – und fassen Sie Fuß im Geschäftsleben. Produzierende Unternehmen unterschiedlichster Branchen warten auf Sie. Sammeln Sie erste Erfahrungen als Staplerfahrer oder Produktionshelfer und erschließen Sie sich Schritt für Schritt weitere Tätigkeitsbereiche, die Ihre Karriere vorantreiben.</p></div>
			<div class="width50 pad-left20"><p>Wer weiß, vielleicht reicht es ja irgendwann zum Millionär? Bis dahin steht Ihnen <a href="<?php echo Yii::getAlias('@web');?>"><b>Job2Job</b></a> zur Seite – mit einem fairen Einkommen als Hilfskraft, Qualifizierungsmaßnahmen und neuen beruflichen Perspektiven.</p></div>
	    	<div class="clear"></div>
		</div>
		<br><br><br>

	</div>

    <?php echo $this->render('blue-jobposition-list', [
        'jobModels' => $jobModels,
        'showSearch' => false, 
        'showMoreFromBranch' => true, 
        'forTitle' => 'FÜR Produktion und Gewerbe',
        'shortCut' => $shortCut,
        
    ]);
    ?>

</div>

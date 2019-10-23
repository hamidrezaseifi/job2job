<?php

/* @var $this yii\web\View */
/* @var $shortCut string */
/* @var $jobModels array */
use yii\helpers\Html;

$this->registerCssFile("@web/web/css/braches.css", [], 'css-braches');
$this->registerCssFile("@web/web/css/imageheader.css", [], 'css-imageheader');

?>

<div class="branch-container">

	<div class="anim-image-header" style="background-image: url(<?=Yii::getAlias('@web')?>/web/images/production.jpg); background-size: 100vw;height: 400px;">

			<div class="anim-image-title" style="top: -150px;">
				Vom Tellerwäscher zum Millionär?<br>
				Jobs in Produktion und Gewerbe
			</div>
	</div>

	<div class="branch-content  margintop-80">
	    <p>
	    	<strong>In Produktion und Gewerbe werden immer wieder motivierte Hilfskräfte gesucht. Sie sind auf der Suche nach einer neuen Herausforderung und wollen in unterschiedliche Branchen reinschnuppern? <a href="<?php echo Yii::getAlias('@web');?>"><b>Job2Job</b></a> hilft Ihnen dabei!</strong>
	    </p>
	    
	    <p>Selbst Milliardäre haben mal klein angefangen. Schon aus diesem Grund nehmen Sie das Sprichwort „Vom Tellerwäscher zum Millionär“ gerne wörtlich? <br> Dann sind Sie bei uns richtig. </p>
	    
	    <p style="border: 1px solid gray; margin: 20px 0; padding: 8px; text-align: center;">Bewerben Sie sich als Aushilfskraft – beispielsweise als Küchenhilfe – und fassen Sie Fuß im Geschäftsleben. Produzierende Unternehmen unterschiedlichster Branchen warten auf Sie. </p>
	    
	    <p style="border: 1px solid gray; margin: 20px 0; padding: 8px; text-align: center;">Sammeln Sie erste Erfahrungen als Staplerfahrer oder Produktionshelfer und erschließen Sie sich Schritt für Schritt weitere Tätigkeitsbereiche, die Ihre Karriere vorantreiben. </p>
	    
	    <p style="border: 1px solid gray; margin: 20px 0; padding: 8px; text-align: center;">Wer weiß, vielleicht reicht es ja irgendwann zum Millionär? Bis dahin steht Ihnen Job2Job zur Seite – mit einem fairen Einkommen als Hilfskraft, Qualifizierungsmaßnahmen und neuen beruflichen Perspektiven. </p>

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

<?php

/* @var $this yii\web\View */
use yii\helpers\Html;

$this->registerCssFile("@web/web/css/braches.css", [], 'css-braches');
$this->registerCssFile("@web/web/css/imageheader.css", [], 'css-imageheader');

?>

<div class="branch-container">

	<div class="anim-image-header" style="background-image: url(<?=Yii::getAlias('@web')?>/web/images/gesundheitswesen-gray.jpg);">

			<div class="anim-image-title">
				Vom Tellerwäscher zum Millionär?<br>
				Jobs in Produktion und Gewerbe
			</div>
	</div>

	<div class="branch-content">
	    <p><b>In Produktion und Gewerbe werden immer wieder motivierte Hilfskräfte gesucht. Sie sind auf der Suche nach einer neuen Herausforderung und wollen in unterschiedliche Branchen reinschnuppern? Job2Job hilft Ihnen dabei!</b></p>
		<p>Selbst Milliardäre haben mal klein angefangen. Schon aus diesem Grund nehmen Sie das Sprichwort „Vom Tellerwäscher zum Millionär“ gerne wörtlich? Dann sind Sie bei uns richtig. Bewerben Sie sich als Aushilfskraft – beispielsweise als Küchenhilfe – und fassen Sie Fuß im Geschäftsleben. Produzierende Unternehmen unterschiedlichster Branchen warten auf Sie. Sammeln Sie erste Erfahrungen als Staplerfahrer oder Produktionshelfer und erschließen Sie sich Schritt für Schritt weitere Tätigkeitsbereiche, die Ihre Karriere vorantreiben.</p>
		<p>Wer weiß, vielleicht reicht es ja irgendwann zum Millionär? Bis dahin steht Ihnen Job2Job zur Seite – mit einem fairen Einkommen als Hilfskraft, Qualifizierungsmaßnahmen und neuen beruflichen Perspektiven.</p>

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

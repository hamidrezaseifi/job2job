<?php

/* @var $this yii\web\View */
use yii\helpers\Html;

$this->registerCssFile("@web/web/css/braches.css", [], 'css-braches');
$this->registerCssFile("@web/web/css/imageheader.css", [], 'css-imageheader');

?>

<div class="branch-container">

	<div class="anim-image-header" style="background-image: url(<?=Yii::getAlias('@web')?>/web/images/personaladoption.jpg); background-size: 100vw;">

			<div class="anim-image-title">
				Personalübernahme:<br> Die clevere Alternative
			</div>
	</div>

	<div class="branch-content">
	    <p>Die Inanspruchnahme von Personal im Zuge der Arbeitnehmerüberlassung ist für Unternehmen praktisch, unkompliziert und zielorientiert. Aber nennen wir das Kind ruhig beim Namen. Sie ist ein notwendiges Übel. Sie ist die Lösung für eine Zwangslage, die im Spannungsfeld von akutem Personalmangel und schleppenden Bewerbungsprozessen entsteht. </p>

	    <div style="margin-top: 20px">
    		<div class="width50 pad-right20"><p>Das Gefühl einen Mitarbeiter, der sich seine Sporen redlich verdient hat, ausschließlich im Rahmen der Arbeitnehmerüberlassung zu beschäftigen, bereitet Ihnen Bauchschmerzen? Damit sind Sie nicht alleine. Gut zu wissen: <strong><a href="<?php echo Yii::getAlias('@web');?>"><b>Job2Job</b></a> bietet Ihnen die Möglichkeit, zuverlässiges Personal zu übernehmen</strong>. Abspracheprobleme sind damit ebenso passé wie Schwierigkeiten bei der langfristigen Geschäftsplanung. Zugleich profitieren Sie von einer <strong>gesteigerten Loyalität und Motivation</strong> Ihrer frischgebackenen Mitarbeiter. </p></div>
    		<div class="width50 pad-left20"><p>Sie haben die Nase voll von Arbeitsverhältnissen auf Zeit? Sprechen Sie uns an! </p></div>
	    	<div class="clear"></div>
		</div>

		<br><br>


	</div>



</div>

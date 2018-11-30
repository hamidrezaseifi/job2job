<?php

/* @var $this yii\web\View */

use yii\helpers\Html;

$this->registerCssFile("@web/web/css/whatwedo.css", [], 'css-wahtwedo');

?>
<div class="site-wahtwedo">
	<div class="site-wahtwedo-content">
		<?php if($part == 2 || $part == 0){?>
		<div class="box1">
			<p class="title1"><b>Was wir machen</b></p>
			<p>Als <b>Unternehmer</b> investieren Sie in mühseliges, zeit- und kostenintensives Recruiting mit <br>ungewissen Erfolgschancen? - Nicht mit uns!</p>
			<p><b>Job2Job GmbH</b> unterstützt Sie von Anfang an bis zum erfolgreichen Abschluss.</p>
			<p>Egal, ob Sie langfristige oder temporäre Positionen besetzen wollen.</p>
			<p>Wir stellen Ihnen geeignete Kandidaten vor – und Sie entscheiden nach Ihren Vorstellungen.<br>Das ist alles.</p> 
			<p>Sie wollen Ihre Entscheidung risikolos testen?<br>Auch das geht - mit einem temporären Überlassungsvertrag, bis Sie sich wirklich sicher sind.</p> 
			<p class="j2jgreentext" ><b>Das ist moderne Personalwirtschaft, zeitsparend und effektiv.</b></p>
		</div>
		<div class="box2"></div>
		<div class="clear"></div>
		<?php 
			} 
			if($part == 1 || $part == 0){
		?>
		<div class="box3">
			<?php if($part != 0){?>
			<p class="title1"><b>Was wir machen</b></p>
			<?php } ?> 
			<p>Als <b>Arbeitnehmer</b> wollen Sie sich verändern? Suchen einen neuen Job, eine neue Aufgabe?<br> Sie wollen sich weiterentwickeln, Ihre Talente einsetzen und neue Wege gehen?</p>
			<br>
			<p>Dann sind Sie bei uns richtig.</p>
			<p><b>Job2Job GmbH</b> ist Ihr kompetenter Wegbegleiter. Wir unterstützen Sie bei der Stellensuche, halten Ihren Aufwand gering und helfen Ihnen Ihr Arbeitsleben so zu gestalten, wie es zu Ihnen passt.</p>
			<br><br>
			<p class="j2jgreentext" ><b>Denn wir bringen zielorientiert die geeigneten Menschen zusammen! Schnell und unkompliziert.</b></p>

		</div>
		<div class="box4"></div>
		 
		 
		<div class="clear"></div>
		<?php } ?> 
	</div>
	
	
</div>





<?php

/* @var $this yii\web\View */
use yii\helpers\Html;

$this->registerCssFile("@web/web/css/braches.css", [], 'css-braches');
$this->registerCssFile("@web/web/css/imageheader.css", [], 'css-imageheader');

?>

<div class="branch-container">

	<div class="anim-image-header" style="background-image: url(<?=Yii::getAlias('@web')?>/web/images/temporarywork.jpg); background-size: 100vw; height: 400px;">

			<div class="anim-image-title" style="top: -150px;">
				Arbeitnehmerüberlassung:<br> Schnell, unkompliziert, zielorientiert
			</div>
	</div>

	<div class="branch-content">
	    <p><strong>Sie suchen dringend neue Mitarbeiter auf Zeit? Wir fackeln nicht lange. <a href="<?php echo Yii::getAlias('@web');?>"><b>Job2Job</b></a> vermittelt Ihnen schnell das benötigte Personal – ganz unbürokratisch. </strong></p>
	    
	    <p>Auftragsspitzen treiben Sie und Ihre Mitarbeiter regelmäßig an die Belastungsgrenze? Temporäre Personalengpässe ruinieren Ihnen die Jahresbilanz? Ihr schärfster Konkurrent schnappt Ihnen ein lukratives Projekt vor der Nase weg – weil es Ihnen am nötigen Know-how fehlt? </p>
	    
	    <p>Das muss nicht sein. Mit <a href="<?php echo Yii::getAlias('@web');?>"><b>Job2Job</b></a> sind Personalengpässe und Know-how-Mangel passé. </p> 
	    
	    <p><strong>So profitieren Sie von der Arbeitnehmerüberlassung: </strong></p>
	    
		
		<ul style="margin-left: 40px;">
            <li>Die kostspielige Personalsuche gehört der Vergangenheit an.</li> 
            <li>Sie verlieren keine Zeit mit der langwierigen Bewerbersuche und -auswahl.</li>
            <li>Ihre hochqualifizierten Mitarbeiter müssen keine Überstunden mit Aushilfstätigkeiten aufbauen – und fokussieren sich ganz auf Ihr Kerngeschäft.</li> 
            <li>Dank der vorübergehenden Einbindung externer Experten in Ihre Prozesse, qualifizieren Sie sich auch für innovative Projekte Ihrer Kunden.</li>
            <li>Sie sind mit der Leistung der vermittelten Arbeitnehmer rundum zufrieden? Eine Personalübernahme ist prinzipiell möglich. </li>
		</ul>
		<br>
		<p><strong>Sprechen Sie uns an. Gemeinsam ermitteln wir Ihren konkreten Personalbedarf – und halten Ihren Aufwand dabei so gering wie möglich. </strong></p>
		<br>
		<br>
		<br>


	</div>



</div>

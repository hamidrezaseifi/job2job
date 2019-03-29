<?php

/* @var $this yii\web\View */
use yii\helpers\Html;

$this->registerCssFile("@web/web/css/braches.css", [], 'css-braches');
$this->registerCssFile("@web/web/css/imageheader.css", [], 'css-imageheader');

?>

<div class="branch-container">

	<div class="anim-image-header" style="background-image: url(<?=Yii::getAlias('@web')?>/web/images/gesundheitswesen-gray.jpg);">

			<div class="anim-image-title">
				Arbeitnehmerüberlassung:<br> Schnell, unkompliziert, zielorientiert
			</div>
	</div>

	<div class="branch-content">
	    <p>Sie suchen dringend neue Mitarbeiter auf Zeit? Wir fackeln nicht lange. <a href="<?php echo Yii::getAlias('@web');?>"><b>Job2Job</b></a> vermittelt Ihnen schnell das benötigte Personal – ganz unbürokratisch. </p>
		<div style="margin-top: 20px">
    		<div class="width50 pad-right20"><p>Auftragsspitzen treiben Sie und Ihre Mitarbeiter regelmäßig an die Belastungsgrenze? Temporäre Personalengpässe ruinieren Ihnen die Jahresbilanz? Ihr schärfster Konkurrent schnappt Ihnen ein lukratives Projekt vor der Nase weg – weil es Ihnen am nötigen Know-how fehlt? </p></div>
    		<div class="width50 pad-left20"><p>Das muss nicht sein. Mit <a href="<?php echo Yii::getAlias('@web');?>"><b>Job2Job</b></a> sind Personalengpässe und Know-how-Mangel passé. So profitieren Sie von der Arbeitnehmerüberlassung: </p></div>
	    	<div class="clear"></div>
		</div>
		
		<div class="box-list">
            <div class="item">Die kostspielige Personalsuche gehört der Vergangenheit an.</div> 
            <div class="item">Sie verlieren keine Zeit mit der langwierigen Bewerbersuche und -auswahl.</div>
            <div class="item">Ihre hochqualifizierten Mitarbeiter müssen keine Überstunden mit Aushilfstätigkeiten aufbauen – und fokussieren sich ganz auf Ihr Kerngeschäft.</div> 
            <div class="item">Dank der vorübergehenden Einbindung externer Experten in Ihre Prozesse, qualifizieren Sie sich auch für innovative Projekte Ihrer Kunden.</div>
            <div class="item">Sie sind mit der Leistung der vermittelten Arbeitnehmer rundum zufrieden? Eine Personalübernahme ist prinzipiell möglich. </div>
	    	<div class="clear"></div>
		</div>
		<br>
		<p>Sprechen Sie uns an. Gemeinsam ermitteln wir Ihren konkreten Personalbedarf – und halten Ihren Aufwand dabei so gering wie möglich. </p>
		<br>


	</div>



</div>

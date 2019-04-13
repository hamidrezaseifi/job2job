<?php

/* @var $this yii\web\View */
/* @var $shortCut string */
/* @var $jobModels array */
use yii\helpers\Html;

$this->registerCssFile("@web/web/css/braches.css", [], 'css-braches');
$this->registerCssFile("@web/web/css/imageheader.css", [], 'css-imageheader');

?>

<div class="branch-container">

	<div class="anim-image-header" style="background-image: url(<?=Yii::getAlias('@web')?>/web/images/commercial.jpg); background-size: 100% 190%;">
		<div class="anim-image-title">
			Impressum
		</div>
	</div>

	<div class="branch-content">
	
        <strong>Job2Job GmbH IMPRESSUM</strong>
        
        <div class="impresum-content">
            <p>
                Job2Job GmbH <br> 
                Pyrmonter Straße 42 <br>
                31789 Hameln <br>
                DEUTSCHLAND <br>
            </p>
            <br>
            
            <ul>
            
            
            <li>Geschäftsführerin: <br>
            Frau Madeleine Mohr</li>
            
            <li>Telefon: +49 5151 556 94-30 <br>
            Telefax: +49 5151 556 94-24</li>
            
            <li>E-Mail: info@job2job-gmbh.de <br>
            Internet: www.job2job-gmbh.de</li>
            
            <li> Handelsregister <br>
            Handelsregister Amtsgericht Stadt Hannover <br>
            Registernummer: HRB 206404</li>
            
            <li>Ust-ID-Nr (gemäß § 27 a Umsatzsteuergesetz): DE274192060</li>
            
            <li>Zuständige Aufsichtsbehörde <br>
            Bundesagentur für Arbeit –Agentur für Arbeit Kiel <br>
            24131 Kiel</li>
            
            <li>Haftung für Links</li>
            
            </ul>
            
        </div>
        
        <p>
            Unsere Webseiten enthalten Links auf externe Webseiten Dritter, deren Inhalte wir nicht beeinflussen können. Für die unter diesen Links hinterlegten und für uns fremden Inhalte übernehmen wir daher keine Gewähr. Für die Inhalte der <br>
            verlinkten Seiten ist stets der jeweilige Anbieter oder Betreiber der verlinkten Seiten verantwortlich. Gleichwohl erfolgte durch uns zum Zeitpunkt der Verlinkung eine Überprüfung der Links auf mögliche Rechtsverstöße. Zum Zeitpunkt der Verlinkung waren für uns rechtswidrige Inhalte nicht erkennbar. Eine permanente inhaltliche Kontrolle der verlinkten Seiten ist jedoch ohne konkrete Anhaltspunkte einer Rechtsverletzung nicht zumutbar. Bei Bekanntwerden von Rechtsverletzungen werden wir jedoch die Verlinkung umgehend aufheben. <br>
        </p>
        
        <p>
        	Dieses Impressum gilt auch für folgende Social Media Profile:
        </p>
        
        <span class="impresum-social-label">Facebook:</span> 
        <a href="https://www.facebook.com/Job2Job-364898756919464/" target="_blank">
			<img alt="" class="impresum-social-icon" src="<?=Yii::getAlias('@web')?>/web/images/facebook.png">
		</a>
        <br>
        
        <span class="impresum-social-label">Xing:</span>
		<a href="https://www.xing.com/profile/Madeleine_Mohr2/cv" target="_blank">
			<img alt="" class="impresum-social-icon" src="<?=Yii::getAlias('@web')?>/web/images/xing.png">
		</a>        
        <br>
        

		<br><br><br>

	</div>


</div>

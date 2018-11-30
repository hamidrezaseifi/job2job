<?php

/* @var $this yii\web\View */

use yii\helpers\Html;

//$this->registerJsFile("@web/web/js/about.js", [], 'js-about');
$this->registerCssFile("@web/web/css/aboutnew.css", [], 'css-about');

$top = ($isindex) ? 980 : 310;
?>

<div class="site-about">

	<div class="site-about-header">
			<img src="<?=Yii::getAlias('@web') ?>/web/images/about3.png" alt="" width="100%">
	</div>
	
	<div class="site-about-container">
		<div class="site-about-title gradgrayline padd">
			<div class="text">Wer wir sind</div>
		</div>
		<p>
			<span class="job2jobgmbhtitle">Job<span class="j2jgreentext">2</span>Job GmbH</span> 
			<div class="textcontainer1">
				ist immer der richtige Ansprechpartner: <br>
				Für Kleinunternehmen genauso wie für den Mittelstand und Großunternehmen – <br>
				denn bei uns sind zuverlässige Bewerber ohne Ausbildung genauso willkommen, <br>
				wie ausgebildete Spezialisten und Akademiker.“ <br> 
				(Madeleine Mohr, Geschäftsführerin)<br>
			
			</div>
		</p>
			
		<div class="gradgrayline padd2"><span class="job2jobgmbhtitle">Job<span class="j2jgreentext">2</span>Job GmbH</span>  ist das bundesweit tätige Unternehmen für </div> 
		
		<div class="padd" >
			<div class="textcontainer2">
				Seit vielen Jahren zeichnet sich unser erfahrenes Experten-Team aus 
				durch Sachkompetenz, 
				gute Netzwerke 
				und Leidenschaft
				 für die Sache: 
				
			</div>
			<div style="float: left;">
				<div style="float: left; width: 500px;">
					<div class="clip-polygon">
						strategische Personalberatung
					</div>
					<div class="clip-polygon polygon2">
						flexible Arbeitnehmerüberlassung
					</div>
					<div class="clip-polygon polygon2line polygon3">
						individuelle Direktsuche/ Personalvermittlung 
					</div>
					
				</div>
			
				<div  style="float: left;margin-top: 30px; margin-left:30px; ">
				
					<div class="listtitle">
						in den Bereichen
					</div>
					<div style="float:left; color: darkblue; background: linear-gradient(240deg, #a9cb14 , #f9fce8); padding-left: 20px; padding-right: 30px;">
						<ul>
							<li>Gesundheitswesen</li>
							<li>Kaufmännischer Sektor</li>
							<li>Industrie und Handwerk</li>
							<li>Ingenieurwesen und Technik</li>
							<li>Lager und Logistik </li>
							<li>Produktion und Gewerbe</li>
						</ul>
						<br>
					</div>	
					<div class="clear"></div>	
				</div>	
					
			</div>
			
			<div class="clear"></div>
		</div>
	
		<div class="arialblack padd" style="margin-top: 50px;">Denn wir bringen zielorientiert die geeigneten Menschen zusammen! Schnell und unkompliziert.</div>
		 
		<?php if($isindex){?>
		<p class="j2jgreentext" id="whatwedoquestion"><b>Und wer sind Sie?</b>  &nbsp; <a class="about-button j2jgreenback" ng-click="showWhatWeDo(1)">Arbeitnehmer</a> &nbsp; &nbsp; &nbsp; <a class="about-button j2jgreenback" ng-click="showWhatWeDo(2)">Unternehmer</a></p>
		<div id="whatwedopart1" style="display:none;" ><?php echo $this->render('whatwedo', ['part' => 1]);?></div>
		<div id="whatwedopart2" style="display:none;" ><?php echo $this->render('whatwedo', ['part' => 2]);?></div>
		<?php } ?>
	
	</div>
	
	
</div>

<script>
	var whatwedourl = "<?php echo Yii::getAlias('@web/site/whatwedo'); ?>";
</script>
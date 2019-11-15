<?php

/* @var $this yii\web\View */
/* @var $recommendations array */

use yii\helpers\Html;

$this->registerCssFile("@web/web/css/company.css", [], 'css-company');
$this->registerCssFile("@web/web/css/index.css", [], 'css-index');

$this->registerJsFile("@web/web/js/candidate.js", [], 'js-candidate');
$this->registerJsFile("@web/web/js/segments-candidate.js", [], 'js-segments');
$this->registerJsFile ( "@web/web/js/recommandation-slider.js", [ ], 'js-recommandation-slider' );

?>
<div ng-controller="CandidateController">
	<div class="home candidate-main-content">
        <div class="home-box-1 top-section top-section-with-boxes" >

			<?php echo $this->render('topbanner', ['showSearch' => false, 'showEmployeeFinder' => true, 'companyPage' => true,]);?>
			
        </div>		
	</div>
	
	<div class="home home-teaser">
		<div class="title">Unsere Geschäftsmodelle</div>

		<div class="teaser-box-container">
    		<div class="teaser-box">
    			<div class="teaser-heaser">Arbeitnehmerüberlassung</div>
    			<div class="teaser-text">Schnell, unkompliziert, zielorientiert <br> und so geht's ...</div>
    			<div class="teaser-link-container"><a class="teaser-link" href="<?=Yii::getAlias('@web') ?>/site/temporarywork">Zur Arbeitnehmerüberlassung </a></div>
    		</div>
		</div>

		<div class="teaser-box-container">
    		<div class="teaser-box">
    			<div class="teaser-heaser">Personalrekrutierung</div>
    			<div class="teaser-text">Die clevere Alternative <br> und so geht's ...</div>
    			<div class="teaser-link-container"><a class="teaser-link" href="<?=Yii::getAlias('@web') ?>/site/personalrecruitment">Zur Personalrekrutierung </a></div>
    		</div>
		</div>

		<div class="teaser-box-container">
    		<div class="teaser-box">
    			<div class="teaser-heaser">Personalübernahme</div>
    			<div class="teaser-text">Für die Zukunft Ihres Unternehmens! <br> und so geht's ...</div>
    			<div class="teaser-link-container"><a class="teaser-link" href="<?=Yii::getAlias('@web') ?>/site/personaladoption">Zur Personalübernahme </a></div>
    		</div>
		</div>

		
		<div class="clear"></div>
	</div>

    <div class="was_wir_machen">
		<div class="content-center">
    		<div class="width50">
				<h2>UNSER VERMITTLUNGSPROZESS<br><strong>FÜR KUNDEN</strong></h2>

                <div class="recruitment_content">
                    <div class="content_ showcontent">
                        <p>Fair, transparent, komfortabel: Bei der Auswahl der für Ihre Vakanzen passenden Kandidaten müssen Sie sich um (fast) nichts kümmern, haben aber jederzeit Einblick in unsere Prozesse – und können bei Bedarf eingreifen. Wie der Recruiting-Prozess im Detail verläuft, veranschaulicht unser bewährtes Pyramiden-Konzept. </p>
                    </div>      
                            
                    <div class="hiddenj2j content_trapezoid4 content_process-item5" style="display: none;">
                      <div class="text-title-bewerber">1. Qualifikation und Anforderungen</div><br>
                      <p>  Wie dringend werden Arbeitskräfte gebraucht? Welche Qualifikationen müssen Bewerber mitbringen? Wo werden diese eingesetzt? Und welches Budget steht überhaupt zur Verfügung? Wir klären gemeinsam mit Ihnen die wichtigsten Fragen. 
                      </p>
                    </div>  
                 
                    <div class="hiddenj2j content_trapezoid3 content_process-item4" style="display: none;">
                      <div class="text-title-bewerber">2. Kandidaten-Suche und -Prüfung</div><br>
                       <p> Auf Basis des zuvor erstellten Anforderungsprofils wählen wir aus unserem weit verzweigten Netzwerk die vielversprechendsten Kandidaten aus. Wir prüfen Referenzen, führen Interviews und machen Eignungstests. Sie lehnen sich entspannt zurück.  
                        </p>
                    </div>  
                 
                    <div class="hiddenj2j content_trapezoid2 content_process-item3" style="display: none;">
                      <div class="text-title-bewerber">3. Präsentation der Kandidaten </div><br>
                       <p> Wir präsentieren Ihnen die ausgewählten Kandidatenprofile – und stellen Ihnen Bewerber auf Wunsch persönlich vor. Dabei begleiten und beraten wir Sie während des gesamten Interview-Prozesses. 
                        </p>
                    </div>  
                 
                    <div class="hiddenj2j content_trapezoid1 content_process-item2" style="display: none;">
                      <div class="text-title-bewerber">4. Vertragsabschluss</div><br>
                       <p> Wurden die vielversprechendsten Kandidaten gefunden, geht es an die Vertragsabwicklung. Die Vertragsverhandlungen mit den Bewerbern führen wir gemäß Ihren Vorgaben, sodass am Ende ein Abschluss steht, den beide Parteien als fair empfinden. 
                        </p>
                    </div>  
                 
                    <div class="hiddenj2j content_triangle-up content_process-item1" style="display: none;">
                      <div class="text-title-bewerber">5. Pflege </div><br>
                      <p>  Unser Konzept der nachhaltigen Betreuung endet nicht mit Vertragsabschluss. Wir stehen Ihnen auch im weiteren Verlauf Ihres Projekts zur Seite und initiieren gerne Verlängerungen der Zusammenarbeit mit den Mitarbeitern Ihrer Wahl. 
                        </p>
                    </div>  
 
                </div>

    		</div>

			
			<div class="width50 no-mobile-item">
				<div ng-click="activeProcess('triangle-up')" class="triangle triangle-up">
					<span class="triangle_content">Pflege</span>
				</div>			

				<div ng-click="activeProcess('trapezoid1')" class="triangle trapezoid1">
					<span class="triangle_content triangle_content-company">Vertrag</span>
				</div>			

				<div ng-click="activeProcess('trapezoid2')" class="triangle trapezoid2">
					<span class="triangle_content">Präsentation der Kandidaten</span>
				</div>			

				<div ng-click="activeProcess('trapezoid3')" class="triangle trapezoid3">
					<span class="triangle_content">Kandidaten-Suche und Prüfung</span>
				</div>			

				<div ng-click="activeProcess('trapezoid4')" class="triangle trapezoid4">
					<span class="triangle_content">Qualifikation und Anforderungen</span>
				</div>			
			</div>
			
			
			<div class="width50 mobile-item">

				<div ng-click="activeProcessItem('process-item5')" class="process-item process-item5">
					<span class="triangle_content">1. Qualifikation und Anforderungen</span>
				</div>			

				<div ng-click="activeProcessItem('process-item4')" class="process-item process-item4">
					<span class="triangle_content">2. Kandidaten-Suche und Prüfung</span>
				</div>			

				<div ng-click="activeProcessItem('process-item3')" class="process-item process-item3">
					<span class="triangle_content">3. Präsentation der Kandidaten</span>
				</div>			

				<div ng-click="activeProcessItem('process-item2')" class="process-item process-item2">
					<span class="triangle_content triangle_content-company">4. Vertrag</span>
				</div>			

				<div ng-click="activeProcessItem('process-item1')" class="process-item process-item1">
					<span class="triangle_content">5. Pflege</span>
				</div>			

			</div>
			
              <br>
              <br>
              <div class="width50 weiter_lesen" style="display: none;">
				<a href="javascript:void(0)"><span class="close_btn"><p>&lt; Zuklappen</p></span></a>
              </div>
          </div>
          <div class="was_wir_machen_bottom" data-show="0"> </div>          
          
    </div>
    
    
    <?php echo $this->render('recommendation', [
        'recommendations' => $recommendations,]);
    ?>
 
 	<?php if(false){?>
    <div class="boxes-ref">
		<div class="content-center statistic-anim" >
			<div class="width25" ng-repeat="statistc in numberStatictics">
				<div class="vertical-align">
					<h5 class="count_up finished">{{Math.round(statistc.currentValue)}}</h5><h5><em>{{statistc.label}}</em></h5>
				</div>
			</div>
		</div>
    </div>
    <?php } ?>
</div>	

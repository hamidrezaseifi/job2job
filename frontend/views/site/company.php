<?php

/* @var $this yii\web\View */
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
		<?php foreach($vacancies as $vacancy){?>
		<div class="teaser-box-container">
    		<div class="teaser-box">
    			<div class="teaser-heaser"><?php echo $vacancy->title;?></div>
    			<div class="teaser-text">Die gründliche Mitarbeitersuche bleibt erfolglos? Leider kein Einzelfall. Der „War of Talents“ wurde selten so hart geführt, wie heute. Gut, dass Sie mit Job2Job einen erfahrenen Verbündeten an Ihrer Seite wissen.</div>
    			<div class="teaser-link-container"><a class="teaser-link" href="<?=Yii::getAlias('@web') ?>/site/<?php echo $vacancy->link;?>">Zum <?php echo $vacancy->title;?> </a></div>
    		</div>
		</div>
		<?php } ?>
		
		<div class="clear"></div>
	</div>
	
	<div class="twobox-container">
	
    	<div class="branch-box-company">
    		<div class="title">Branchen</div>
    		<?php foreach($branches as $branch){?>
    			<a href="<?=Yii::getAlias('@web') ?>/site/branchview/candidate/<?php echo $branch->shortcut;?>">
    				<div class="branch-item"> 
    					<img alt="" src="<?php echo Yii::getAlias('@web') . $branch->logo;?>">
    					<span><?php echo $branch->title;?> >></span>
    				</div>
    			</a>
    		<?php } ?>    	
    	</div>
    	
    	<div class="clear"></div>
    	
	</div>

    <div class="was_wir_machen">
		<div class="content-center">
    		<div class="width50">
				<h2>UNSER VERMITTLUNGSPROZESS<br><strong>FÜR KUNDEN</strong></h2>

                <div class="content_ showcontent">
                    <p>Fair, transparent, komfortabel: Bei der Auswahl der für Ihre Vakanzen passenden Kandidaten müssen Sie sich um (fast) nichts kümmern, haben aber jederzeit Einblick in unsere Prozesse – und können bei Bedarf eingreifen. Wie der Recruiting-Prozess im Detail verläuft, veranschaulicht unser bewährtes Pyramiden-Konzept. </p>
                </div>
      
                <div class="recruitment_content">
                            
                    <div class="hiddenj2j content_trapezoid4" style="display: block;">
                      <div class="text-title-bewerber">1. Qualifikation und Anforderungen</div><br>
                      <p>  Wie dringend werden Arbeitskräfte gebraucht? Welche Qualifikationen müssen Bewerber mitbringen? Wo werden diese eingesetzt? Und welches Budget steht überhaupt zur Verfügung? Wir klären gemeinsam mit Ihnen die wichtigsten Fragen. 
                      </p>
                    </div>  
                 
                    <div class="hiddenj2j content_trapezoid3" style="display: none;">
                      <div class="text-title-bewerber">2. Kandidaten-Suche und -Prüfung</div><br>
                       <p> Auf Basis des zuvor erstellten Anforderungsprofils wählen wir aus unserem weit verzweigten Netzwerk die vielversprechendsten Kandidaten aus. Wir prüfen Referenzen, führen Interviews und machen Eignungstests. Sie lehnen sich entspannt zurück.  
                        </p>
                    </div>  
                 
                    <div class="hiddenj2j content_trapezoid2" style="display: none;">
                      <div class="text-title-bewerber">3. Präsentation der Kandidaten </div><br>
                       <p> Wir präsentieren Ihnen die ausgewählten Kandidatenprofile – und stellen Ihnen Bewerber auf Wunsch persönlich vor. Dabei begleiten und beraten wir Sie während des gesamten Interview-Prozesses. 
                        </p>
                    </div>  
                 
                    <div class="hiddenj2j content_trapezoid1" style="display: none;">
                      <div class="text-title-bewerber">4. Vertragsabschluss</div><br>
                       <p> Wurden die vielversprechendsten Kandidaten gefunden, geht es an die Vertragsabwicklung. Die Vertragsverhandlungen mit den Bewerbern führen wir gemäß Ihren Vorgaben, sodass am Ende ein Abschluss steht, den beide Parteien als fair empfinden. 
                        </p>
                    </div>  
                 
                    <div class="hiddenj2j content_triangle-up" style="display: none;">
                      <div class="text-title-bewerber">5. Pflege </div><br>
                      <p>  Unser Konzept der nachhaltigen Betreuung endet nicht mit Vertragsabschluss. Wir stehen Ihnen auch im weiteren Verlauf Ihres Projekts zur Seite und initiieren gerne Verlängerungen der Zusammenarbeit mit den Mitarbeitern Ihrer Wahl. 
                        </p>
                    </div>  
 
                </div>

    		</div>
    
    		<?php if(false){?>
    		<div class="width50">
                <div class="squarewrapper2">
                    <div class="square2 square-fixed">
                        <div class="csscircle circleRad2">
                            <div class="segmentwrapper segment1 fade-in2 one start" id="seg1">
                                <div class="segment">
                                  <div class="inner" id="seg1">
                                  	<p class="circle2_text txt1-2">1. Qualifikation und Chancen</p>
                                  </div>
                                </div>
                            </div>
                            <div class="segmentwrapper segment2 fade-in2 two start" id="seg2">
                                <div class="segment">
                                	<div class="inner" id="seg2">
                                		<p class="circle2_text txt2-2" style="max-width: 120px;">2. Vorstellung passender Stellen</p>
                            		</div>
                            	</div>
                            </div>
                            <div class="segmentwrapper segment3 fade-in2 three start" id="seg3">
                                <div class="segment"><div class="inner" id="seg3">
                        		<p class="circle2_text txt3-2">3. Präsentation beim Arbeitgeber</p>
                            </div></div>
                            </div>
                            <div class="segmentwrapper segment4 fade-in2 four start" id="seg4">
                                <div class="segment"><div class="inner" id="seg4">
                        		<p class="circle2_text txt4-2">4. Interviews</p>
                            </div></div>
                            </div>
                            <div class="segmentwrapper segment5 fade-in2 five start" id="seg5">
                                <div class="segment"><div class="inner" id="seg5">
                        		<p class="circle2_text txt5-2">5. Vertrag</p>
                            </div></div>
                            </div>
                            <div class="segmentwrapper segment6 fade-in2 six start" id="seg6">
                                <div class="segment"><div class="inner" id="seg6">
                        		<p class="circle2_text txt6-2">6. Be-treuung</p>
                            </div></div>
                            </div>
                             <div class="cutout3"><p class="fade-in five circle_text5 start"></p></div>
                        </div>
                    </div>
                </div>
            </div> 
			<?php } ?>
			
			<div class="width50">
				<div ng-click="activeProcess('triangle-up')" class="triangle triangle-up"><span class="triangle_content">Pflege</span></div>			

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
			
              <br>
              <br>
              <div class="width50 weiter_lesen" style="display: none;">
				<a href="javascript:void(0)"><span class="close_btn"><p>&lt; Zuklappen</p></span></a>
              </div>
          </div>
          <div class="was_wir_machen_bottom" data-show="0"> </div>          
          
    </div>
    
    
    <div class="all-slider recommendations-slider das_sagen_kunden" style="">
				
		<div class="content-center"><h2 style="position: absolute;">DAS SAGEN<strong>UNSERE KUNDEN</strong></h2></div>
		<div class="caroufredsel_wrapper" style="display: block; text-align: start; float: none; position: relative; top: auto; right: auto; bottom: auto; left: auto; z-index: auto;margin: 0px; overflow: hidden;">
			<div class="slider-kunden" style="text-align: left; float: none; position: absolute; top: 0px; right: auto; bottom: auto; left: 0px; margin: 0px; width: 17127px; height: 600px; z-index: auto; opacity: 1;">

	 			<div class="each-slide-kunden" style="">
    				<div class="content-center">
    					<div class="slider2-content">
    						<div class="pagination2" style="display: block;">
    							<?php foreach ($recommendations as $index => $recommendation ){?>
    							<a ng-click="showPaginationContent('<?php echo $index + 1;?>', true)" data-iscandidate="<?php echo $recommendation->iscandidate; ?>" id="link<?php echo $index + 1;?>" <?php echo $index == 0 ? 'class="selected"' : ''; ?>><span><?php echo $index + 1;?></span></a>
    							<?php } ?>
    						</div>
    						<div class="vertical-align">
    							<div style="margin-bottom: 0px!important;" class="pagination-content">
    							<?php foreach ($recommendations as $index => $recommendation ){?>
                                    <div id="item<?php echo $index + 1;?>" class="fade <?php echo $index == 0 ? 'in' : ''; ?> pagination-content-item">
                                      <div class="recomand-content"><?php echo $recommendation->recommendation;?></div>
                                      <div class="recomand-title"></div>
                                    </div>
     							<?php } ?>
    							</div>
    						</div>
    					</div>	
    				</div>							
				</div>
			</div>
		</div>
	</div>
 
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

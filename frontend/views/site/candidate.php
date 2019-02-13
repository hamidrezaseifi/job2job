<?php

use yii\bootstrap\ActiveForm;

//jobpositionDataProvider
/* @var $this yii\web\View */
/* @var $jobitems string */
/* @var $places array */

$this->title = yii::$app->params['sitetitle'] . ' | ' . Yii::t('app', 'Home Page');

$this->registerJsFile("@web/web/js/candidate.js", [], 'js-candidate');
$this->registerJsFile("@web/web/js/segments-candidate.js", [], 'js-segments');
$this->registerCssFile("@web/web/css/segments-candidate.css", [], 'css-segment');
$this->registerCssFile("@web/web/css/candidate.css", [], 'css-candidate');
$this->registerJsFile ( "@web/web/js/recommandation-slider.js", [ ], 'js-recommandation-slider' );

?>

<div ng-controller="CandidateController">
	<div class="home candidate-main-content">
        <div class="home-box-1 top-section top-section-with-boxes" >

			<?php echo $this->render('topbanner', ['showSearch' => true, 'candidatePage' => true, ]);?>
			
			<?php  if(false){?>
        	<div class="content-center960">
        		<div class="steps">
        			<div class="step1 eachstep">
        				<h2 class="light-and-bold text-over-image" ><span>Welche Art von <strong>Beschäftigung </strong> suchen Sie?</span></h2>
        				<div class="chooseoptions">
        					<div class="option1" ng-repeat="branch in branchs ">
        						<a href="<?=Yii::getAlias('@web') ?>/site/branchview/candidate/{{branch.shortcut}}">
            						<div class="eachbox eachboxheight">							
            							<div class="verticalmiddle">
            								<h4>{{branch.label}}</h4>
            								<p><img alt="" ng-src="<?=Yii::getAlias('@web') ?>{{branch.logo}}"></p>
            								
            							</div>
            						</div>						
        						</a>
        						
        					</div>
        					
        				</div>
        			</div> 
        		</div>
        	</div>
        	<?php } ?>
        </div>		
	</div>
	
    <?php  if(false){?>
    <div class="blue-section-aktuelle ">
    	<div class="content-center">
    		<h2>AKTUELLE STELLENANGEBOTE<br>
    			<strong>FÜR BEWERBER</strong></h2>
    				<div class="boxes-aktuelle boxesnumber4">
    				<?php foreach($jobModels as $jobModel){
    				    $jobtitle = $jobModel->title; //strlen($jobModel->title) > 32 ? substr($jobModel->title , 0 , 30) . ' ...' : $jobModel->title;
    				    ?>
    					<div class="box-aktuelle" style="position:relative;" onclick="location.href='<?=Yii::getAlias('@web') ?>/site/jobview?id=<?php echo $jobModel->id; ?>'">
    						<h4><?php echo $jobtitle?></h4>
    						<div style="margin: 10px 0;"><?php echo $jobModel->city?></div>
    						<div style="max-height:220px; height:220px; overflow:hidden; ">
    							<?php echo $jobModel->comments?>
    						</div>
    						<p style="margin-top: 15px;">
    							<a href="<?=Yii::getAlias('@web') ?>/site/jobview?id=<?php echo $jobModel->id; ?>">Mehr erfahren &gt;</a>
    						</p>
    					</div>
    				<?php }?>
    
    		</div>	
    				<div class="button-aktuelle">
    			<p><a href="<?=Yii::getAlias('@web') ?>/site/searchjobs/">JOB SUCHEN</a></p>
    		</div>
    	</div>
    </div>
    <?php } ?>

	<div class="wir-fordern-ihre-karriere">
		<div class="content-center">
		
			<div class="all-boxes-karriere">
					
			        <div class="box-karriere">
						<img src="<?=Yii::getAlias('@web/web') ?>/images/bird-env.png">
						<div class="title-karriere">LEBENSLAUF EINREICHEN</div>
						<div class="text-karriere">Berufliche Perspektive gesucht? Schicken Sie uns noch heute Ihren Lebenslauf und wir melden uns mit einer beruflichen Herausforderung, die nur auf Sie zugeschnitten ist! </div>
						<a href="#" >mehr erfahren</a>
					</div>		
			 		
			        <div class="box-karriere">
						<img src="<?=Yii::getAlias('@web/web') ?>/images/envelope1.png">
						<div class="title-karriere">ZUM JOB-TICKER ANMELDEN</div>
						<div class="text-karriere">Anmelden. Wunschkriterien definieren. Zurücklehnen. Wir versorgen Sie mit interessanten Jobangeboten. Noch nie war es leichter, den persönlichen Traumjob zu finden.</div>
						<a href="#" >mehr erfahren</a>
					</div>		
			 		
			        <div class="box-karriere">
						<img src="<?=Yii::getAlias('@web/web') ?>/images/edit-note.png">
						<div class="title-karriere" style="width: 280px;">INDIVIDUELLE MERKLISTE ANLEGEN</div>
						<div class="text-karriere" style="height: 125px">Bewahren Sie die Übersicht über Ihre bevorzugten Stellenangebote und fügen Sie vielversprechende Inserate Ihrer persönlichen Merkliste hinzu. </div>
						<a href="#" >mehr erfahren</a>
					</div>		
			 </div>
		</div>
		<div class="wir-fordern-ihre-karriere-bottom" data-show="0"></div>
	</div>
	
	<div class="twobox-container">
	
		<div class="content-center">
			<div ><h2><strong>BRANCHE AUSWÄHLEN - LOS GEHT'S</strong></h2></div>
		</div>
		
				
    	<div class="branch-box">
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
	
    	<div class="job-box">
     		<div class="title">Jobbörse</div>
    		<?php foreach($jobs as $job){?>
    			<a href="<?=Yii::getAlias('@web') ?>/site/jobview/<?php echo $job->id;?>">
    				<div class="job-item"> 
     					<span><?php echo $job->title;?></span>
    				</div>
    			</a>
    		<?php } ?>
    	
    	</div>
    	
    	<div class="clear"></div>
    	
	</div>

    <div class="was_wir_machen">
		<div class="content-center">
    		<div class="width50">
				<h2>UNSER VERMITTLUNGSPROZESS<br><strong>FÜR BEWERBER</strong></h2>

                <div class="content_ showcontent">
                    <p>Stein für Stein: Job2Job baut an Ihrer Zukunft. Warum wir uns gerne als Baumeister Ihrer beruflichen Träume sehen, verdeutlicht unser Pyramiden-Modell. Gemeinsam entwickeln wir einen Plan für Ihre persönliche berufliche Perspektive. Sie haben die Vision, wir das Know-how und die Beziehungen, um Sie Realität werden zu lassen. </p>
                </div>
      
                <div class="recruitment_content">
                            
                    <div class="hiddenj2j content_trapezoid5" style="display: block;">
                      <div class="text-title-bewerber">1. Qualifikation und Chancen</div><br>
                      <p>  Gemeinsam mit Ihnen entwerfen wir das Gerüst für Ihren perfekten Job. Auf Basis Ihrer beruflichen Ziele, Gehaltsvorstellungen, Qualifikationen und Co. geben wir Ihnen eine realistische Einschätzung Ihrer Job-Chancen. 
                      </p>
                    </div>  
                 
                    <div class="hiddenj2j content_trapezoid4" style="display: none;">
                      <div class="text-title-bewerber">2. Vorstellung passender Stellen</div><br>
                       <p> Was wünscht der Kunde von künftigen Mitarbeitern? Wie arbeitet es sich im entsprechenden Unternehmen? Gibt es Bonuszahlungen? Bekomme ich einen Firmenwagen? Wir stellen Ihnen nicht nur auf Sie zugeschnittene Positionen vor, sondern beantworten Ihnen alle wichtigen Fragen zur möglichen Stelle. 
                        </p>
                    </div>  
                 
                    <div class="hiddenj2j content_trapezoid3" style="display: none;">
                      <div class="text-title-bewerber">3. Präsentation beim Arbeitgeber </div><br>
                       <p> Sobald wir die passende Stelle für Sie gefunden haben, optimieren wir Ihre Bewerbungsunterlagen und stellen Sie beim Kunden vor. Unsere qualifizierte Vermittlung verschafft Ihnen einen entscheidenden Wettbewerbsvorteil gegenüber Ihren Mitbewerbern. 
                        </p>
                    </div>  
                 
                    <div class="hiddenj2j content_trapezoid2" style="display: none;">
                      <div class="text-title-bewerber">4. Interviews</div><br>
                       <p> Als aussichtsreicher Kandidat werden Sie zum Interview bei Ihrem potenziellen Arbeitgeber geladen. Wir sorgen dafür, dass Sie bestmöglich auf das Gespräch vorbereitet sind. Im Anschluss analysieren wir das Interview und geben Ihnen Tipps für künftige Gespräche mit auf den Weg. 
                        </p>
                    </div>  
                 
                    <div class="hiddenj2j content_trapezoid1" style="display: none;">
                      <div class="text-title-bewerber">5. Vertrag</div><br>
                      <p>  Auch bei den Vertragsverhandlungen stehen wir Ihnen zur Seite. Wir führen die Verhandlungen und unterbreiten Ihnen das Angebot des Kunden. Zu einem Abschluss kommt es nur, wenn Sie rundum zufrieden sind. 
                        </p>
                    </div>  
                 
                    <div class="hiddenj2j content_triangle-up" style="display: none;">
                      <div class="text-title-bewerber">6. Pflege</div><br>
                       <p> Eine ganzheitliche und nachhaltige Betreuung steht bei uns an oberster Stelle. Wir weichen Ihnen während des gesamten Recruitment-Prozesses nicht von der Seite und begleiten Sie auch darüber hinaus. 
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
					<span class="triangle_content">Vertrag</span>
				</div>			

				<div ng-click="activeProcess('trapezoid2')" class="triangle trapezoid2">
					<span class="triangle_content">Interviews</span>
				</div>			

				<div ng-click="activeProcess('trapezoid3')" class="triangle trapezoid3">
					<span class="triangle_content">Präsentation beim Arbeitgeber</span>
				</div>			

				<div ng-click="activeProcess('trapezoid4')" class="triangle trapezoid4">
					<span class="triangle_content">Vorstellung passender Stellen</span>
				</div>			

				<div ng-click="activeProcess('trapezoid5')" class="triangle trapezoid5">
					<span class="triangle_content">Qualifikation und Chancen</span>
				</div>			
			</div>
			
              <br>
              <br>
              
          </div>
		<div class="was_wir_machen_bottom" data-show="0"> </div>          
    </div>
    
    
    <div class="all-slider recommendations-slider das_sagen_kunden_candidate" style="">
				
		<div class="content-center"><h2 style="position: absolute;">DAS SAGEN<strong>UNSERE KANDIDATEN</strong></h2></div>
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
                                      <div class="recomand-title"><?php echo $recommendation->title;?></div>
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


    
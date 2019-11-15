<?php

use yii\bootstrap\ActiveForm;

/* @var $this yii\web\View */
/* @var $jobitems string */
/* @var $places array */
/* @var $recommendations array */

$this->title = yii::$app->params['sitetitle'] . ' | ' . Yii::t('app', 'Home Page');

$this->registerJsFile("@web/web/js/candidate.js", [], 'js-candidate');
$this->registerJsFile("@web/web/js/segments-candidate.js", [], 'js-segments');
$this->registerCssFile("@web/web/css/segments-candidate.css", [], 'css-segment');
$this->registerCssFile("@web/web/css/candidate.css", [], 'css-candidate');
$this->registerJsFile ( "@web/web/js/recommandation-slider.js", [ ], 'js-recommandation-slider' );

?>

<div ng-controller="CandidateController">
	<div class="home candidate-main-content">
        <div class="candidate-box top-section top-section-with-boxes" >

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
						<img src="<?=Yii::getAlias('@web/web') ?>/images/icon1-2.jpg">
						<div class="title-karriere">LEBENSLAUF EINREICHEN</div>
						<div class="text-karriere">Berufliche Perspektive gesucht? Schicken Sie uns noch heute Ihren Lebenslauf und wir melden uns mit einer beruflichen Herausforderung, die nur auf Sie zugeschnitten ist! </div>
						<a href="#" >mehr erfahren</a>
					</div>		
			 		
			        <div class="box-karriere">
						<img src="<?=Yii::getAlias('@web/web') ?>/images/icon2-2.jpg">
						<div class="title-karriere">ZUM JOB-TICKER ANMELDEN</div>
						<div class="text-karriere">Anmelden. Wunschkriterien definieren. Zurücklehnen. Wir versorgen Sie mit interessanten Jobangeboten. Noch nie war es leichter, den persönlichen Traumjob zu finden.</div>
						<a href="#" >mehr erfahren</a>
					</div>		
			 		
			        <div class="box-karriere">
						<img src="<?=Yii::getAlias('@web/web') ?>/images/icon3-2.jpg">
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

                <div class="recruitment_content">
                    <div class="content_ showcontent">
                        <p>Stein für Stein: Job2Job baut an Ihrer Zukunft. Warum wir uns gerne als Baumeister Ihrer beruflichen Träume sehen, verdeutlicht unser Pyramiden-Modell. Gemeinsam entwickeln wir einen Plan für Ihre persönliche berufliche Perspektive. Sie haben die Vision, wir das Know-how und die Beziehungen, um Sie Realität werden zu lassen. </p>
                    </div>
                                  
                    <div class="hiddenj2j content_trapezoid5 content_process-item6" style="display: none;">
                      <div class="text-title-bewerber">1. Qualifikation und Chancen</div><br>
                      <p>  Gemeinsam mit Ihnen entwerfen wir das Gerüst für Ihren perfekten Job. Auf Basis Ihrer beruflichen Ziele, Gehaltsvorstellungen, Qualifikationen und Co. geben wir Ihnen eine realistische Einschätzung Ihrer Job-Chancen. 
                      </p>
                    </div>  
                 
                    <div class="hiddenj2j content_trapezoid4 content_process-item5" style="display: none;">
                      <div class="text-title-bewerber">2. Vorstellung passender Stellen</div><br>
                       <p> Was wünscht der Kunde von künftigen Mitarbeitern? Wie arbeitet es sich im entsprechenden Unternehmen? Gibt es Bonuszahlungen? Bekomme ich einen Firmenwagen? Wir stellen Ihnen nicht nur auf Sie zugeschnittene Positionen vor, sondern beantworten Ihnen alle wichtigen Fragen zur möglichen Stelle. 
                        </p>
                    </div>  
                 
                    <div class="hiddenj2j content_trapezoid3 content_process-item4" style="display: none;">
                      <div class="text-title-bewerber">3. Präsentation beim Arbeitgeber </div><br>
                       <p> Sobald wir die passende Stelle für Sie gefunden haben, optimieren wir Ihre Bewerbungsunterlagen und stellen Sie beim Kunden vor. Unsere qualifizierte Vermittlung verschafft Ihnen einen entscheidenden Wettbewerbsvorteil gegenüber Ihren Mitbewerbern. 
                        </p>
                    </div>  
                 
                    <div class="hiddenj2j content_trapezoid2 content_process-item3" style="display: none;">
                      <div class="text-title-bewerber">4. Interviews</div><br>
                       <p> Als aussichtsreicher Kandidat werden Sie zum Interview bei Ihrem potenziellen Arbeitgeber geladen. Wir sorgen dafür, dass Sie bestmöglich auf das Gespräch vorbereitet sind. Im Anschluss analysieren wir das Interview und geben Ihnen Tipps für künftige Gespräche mit auf den Weg. 
                        </p>
                    </div>  
                 
                    <div class="hiddenj2j content_trapezoid1 content_process-item2" style="display: none;">
                      <div class="text-title-bewerber">5. Vertrag</div><br>
                      <p>  Auch bei den Vertragsverhandlungen stehen wir Ihnen zur Seite. Wir führen die Verhandlungen und unterbreiten Ihnen das Angebot des Kunden. Zu einem Abschluss kommt es nur, wenn Sie rundum zufrieden sind. 
                        </p>
                    </div>  
                 
                    <div class="hiddenj2j content_triangle-up content_process-item1" style="display: none;">
                      <div class="text-title-bewerber">6. Pflege</div><br>
                       <p> Eine ganzheitliche und nachhaltige Betreuung steht bei uns an oberster Stelle. Wir weichen Ihnen während des gesamten Recruitment-Prozesses nicht von der Seite und begleiten Sie auch darüber hinaus. 
                        </p>
                    </div>  
                </div>

    		</div>
    
			
			<div class="width50 no-mobile-item">
				<div ng-click="activeProcess('triangle-up')" class="triangle triangle-up">
					<span class="triangle_content">Pflege</span>
				</div>			

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
			
			<div class="width50 mobile-item">
				<div ng-click="activeProcessItem('process-item6')" class="process-item process-item6">
					<span class="triangle_content">1. Qualifikation und Chancen</span>
				</div>			

				<div ng-click="activeProcessItem('process-item5')" class="process-item process-item5">
					<span class="triangle_content">2. Vorstellung passender Stellen</span>
				</div>			

				<div ng-click="activeProcessItem('process-item4')" class="process-item process-item4">
					<span class="triangle_content">3. Präsentation beim Arbeitgeber</span>
				</div>			

				<div ng-click="activeProcessItem('process-item3')" class="process-item process-item3">
					<span class="triangle_content">4. Interviews</span>
				</div>			

				<div ng-click="activeProcessItem('process-item2')" class="process-item process-item2">
					<span class="triangle_content">5. Vertrag</span>
				</div>			

				<div ng-click="activeProcessItem('process-item1')" class="process-item process-item1">
					<span class="triangle_content">6. Pflege</span>
				</div>			

			</div>
			
            <br>
            <br>
              
          </div>
          <div class="clear"></div>
		<div class="was_wir_machen_bottom" data-show="0"> </div>          
    </div>
    
    <?php echo $this->render('recommendation', [
        'recommendations' => $recommendations,]);
    ?>

 
</div>	


    
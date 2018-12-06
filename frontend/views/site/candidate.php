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

?>

<div ng-controller="CandidateController">
	<div class="home candidate-main-content">
        <div class="home-box-1 top-section top-section-with-boxes" >

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
        	
        </div>		
	</div>
	
    
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

<div class="wir-fordern-ihre-karriere">
		<div class="content-center">
			<h3 class="light-and-bold">WIR ERMÖGLICHEN IHNEN <strong> EINE NACHHALTIGE KARRIERE</strong></h3>
		
						<div class="all-boxes-karriere">
						
				        <div class="box-karriere">
							<img src="<?=Yii::getAlias('@web/web') ?>/images/envelope1.png">
							<div class="title-karriere">ZUM JOB-TICKER ANMELDEN</div>
							<div class="text-karriere">Anmelden. Wunschkriterien definieren. Zurücklehnen. Wir versorgen Sie mit interessanten Jobangeboten. Noch nie war es leichter, den persönlichen Traumjob zu finden.</div>
						</div>		
				 		
				        <div class="box-karriere">
							<img src="<?=Yii::getAlias('@web/web') ?>/images/bird-env.png">
							<div class="title-karriere">LEBENSLAUF EINREICHEN</div>
							<div class="text-karriere">Berufliche Perspektive gesucht? Schicken Sie uns noch heute Ihren Lebenslauf und wir melden uns mit einer beruflichen Herausforderung, die nur auf Sie zugeschnitten ist! </div>
						</div>		
				 		
				        <div class="box-karriere">
							<img src="<?=Yii::getAlias('@web/web') ?>/images/edit-note.png">
							<div class="title-karriere">INDIVIDUELLE MERKLISTE ANLEGEN</div>
							<div class="text-karriere">Bewahren Sie die Übersicht über Ihre bevorzugten Stellenangebote und fügen Sie vielversprechende Inserate Ihrer persönlichen Merkliste hinzu. </div>
						</div>		
				 			</div>
					</div>
	</div>
	



    
    <div class="was_wir_machen">
		<div class="content-center">
    		<div class="width50">
				<h2>UNSER VERMITTLUNGSPROZESS<br><strong>FÜR BEWERBER</strong></h2>

                <div class="recruitment_hidden">
                    <p>Stein für Stein: Job2Job baut an Ihrer Zukunft. Warum wir uns gerne als Baumeister Ihrer beruflichen Träume sehen, verdeutlicht unser Pyramiden-Modell. Gemeinsam entwickeln wir einen Plan für Ihre persönliche berufliche Perspektive. Sie haben die Vision, wir das Know-how und die Beziehungen, um Sie Realität werden zu lassen. </p>
                </div>
      
                <div class="recruitment_content">
                            
                    <div class="hiddenj2j content_seg1" style="display: block;">
                      <div class="text-title-bewerber">1. Qualifikation und Chancen</div><br>
                      <p>  Gemeinsam mit Ihnen entwerfen wir das Gerüst für Ihren perfekten Job. Auf Basis Ihrer beruflichen Ziele, Gehaltsvorstellungen, Qualifikationen und Co. geben wir Ihnen eine realistische Einschätzung Ihrer Job-Chancen. 
                      </p>
                    </div>  
                 
                    <div class="hiddenj2j content_seg2" style="display: none;">
                      <div class="text-title-bewerber">2. Vorstellung passender Stellen</div><br>
                       <p> Was wünscht der Kunde von künftigen Mitarbeitern? Wie arbeitet es sich im entsprechenden Unternehmen? Gibt es Bonuszahlungen? Bekomme ich einen Firmenwagen? Wir stellen Ihnen nicht nur auf Sie zugeschnittene Positionen vor, sondern beantworten Ihnen alle wichtigen Fragen zur möglichen Stelle. 
                        </p>
                    </div>  
                 
                    <div class="hiddenj2j content_seg3" style="display: none;">
                      <div class="text-title-bewerber">3. Präsentation beim Arbeitgeber </div><br>
                       <p> Sobald wir die passende Stelle für Sie gefunden haben, optimieren wir Ihre Bewerbungsunterlagen und stellen Sie beim Kunden vor. Unsere qualifizierte Vermittlung verschafft Ihnen einen entscheidenden Wettbewerbsvorteil gegenüber Ihren Mitbewerbern. 
                        </p>
                    </div>  
                 
                    <div class="hiddenj2j content_seg4" style="display: none;">
                      <div class="text-title-bewerber">4. Interviews</div><br>
                       <p> Als aussichtsreicher Kandidat werden Sie zum Interview bei Ihrem potenziellen Arbeitgeber geladen. Wir sorgen dafür, dass Sie bestmöglich auf das Gespräch vorbereitet sind. Im Anschluss analysieren wir das Interview und geben Ihnen Tipps für künftige Gespräche mit auf den Weg. 
                        </p>
                    </div>  
                 
                    <div class="hiddenj2j content_seg5" style="display: none;">
                      <div class="text-title-bewerber">5. Vertrag</div><br>
                      <p>  Auch bei den Vertragsverhandlungen stehen wir Ihnen zur Seite. Wir führen die Verhandlungen und unterbreiten Ihnen das Angebot des Kunden. Zu einem Abschluss kommt es nur, wenn Sie rundum zufrieden sind. 
                        </p>
                    </div>  
                 
                    <div class="hiddenj2j content_seg6" style="display: none;">
                      <div class="text-title-bewerber">6. Betreuung</div><br>
                       <p> Eine ganzheitliche und nachhaltige Betreuung steht bei uns an oberster Stelle. Wir weichen Ihnen während des gesamten Recruitment-Prozesses nicht von der Seite und begleiten Sie auch darüber hinaus. 
                        </p>
                    </div>  
                </div>

    		</div>
    
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

              <br>
              <br>
              <div class="width50 weiter_lesen" style="display: none;">
				<a href="javascript:void(0)"><span class="close_btn"><p>&lt; Zuklappen</p></span></a>
              </div>
          </div>
    </div>
    
    
    <div class="all-slider das_sagen_kunden_candidate" style="">
				
			<div class="content-center">
				<h2 style="position: absolute;">DAS SAGEN<strong>UNSERE KUNDEN</strong></h2></div>
				<div class="caroufredsel_wrapper" style="display: block; text-align: start; float: none; position: relative; top: auto; right: auto; bottom: auto; left: auto; z-index: auto;margin: 0px; overflow: hidden;"><div class="slider-kunden" style="text-align: left; float: none; position: absolute; top: 0px; right: auto; bottom: auto; left: 0px; margin: 0px; width: 17127px; height: 600px; z-index: auto; opacity: 1;">
		
	 				<div class="each-slide-kunden" style="">
				<div class="content-center">
					<div class="slider2-content">
						<div class="pagination2" style="display: block;">
							<a ng-click="showPaginationContent('1', $event)" id="link1" class="selected"><span>1</span></a>
							<a ng-click="showPaginationContent('2', $event)" id="link2" class=""><span>2</span></a>
							<a ng-click="showPaginationContent('3', $event)" id="link3" class=""><span>3</span></a>
							<a ng-click="showPaginationContent('4', $event)" id="link4" class=""><span>4</span></a>
						</div>
						<div class="vertical-align">
							<div style="margin-bottom: 0px!important;" class="pagination-content">
                                <div id="item1" class="fade in pagination-content-item">
                                  <p>„Ich kann Aristo nur als Personalberatung weiterempfehlen. Hier finden Sie integre Partner, die sich Ihrem Auftrag wirklich verpflichtet fühlen.“</p>
                                </div>
                                <div id="item2" class="fade pagination-content-item">
                                  <p>„Ich kann Aristo nur wärmsten Herzens an Experten empfehlen, die auf der Suche sind nach einer positiven beruflichen Veränderung. Ich bin Aristo äußerst dankbar für die Hilfe bei der Suche nach meinem Traumjob.“</p>
                                </div>
                                <div id="item3" class="fade pagination-content-item">
                                  <p>„Ich freue mich sehr, mit Aristo zusammenzuarbeiten. Ich habe sie als zuverlässigen Partner im Projektgeschäft kennengelernt. Unsere Zusammenarbeit ist geprägt von gegenseitigem Vertrauen und Respekt.“</p>
                                </div>
                                <div id="item4" class="fade pagination-content-item">
                                  <p>“In meinen Augen ist genau der sehr persönliche und gleichzeitig professionelle Umgang zwischen Aristo und den Partnern auf Unternehmer- als auch Beraterseite eines der Erfolgsgeheimnisse der Aristo Gruppe. Ich bedanke mich beim gesamten Team und wünsche noch viele weitere erfolgreiche Jahre.”</p>
                                </div>
							</div>
						</div>
					</div>	
				</div>							
			</div><div class="each-slide-kunden" style="">
				<div class="content-center">
					<div class="slider2-content">
						<div class="pagination2" style="display: block;"><a href="#" class=""><span>1</span></a><a href="#" class=""><span>2</span></a><a href="#" class="selected"><span>3</span></a><a href="#" class=""><span>4</span></a></div>
						<div class="vertical-align">
							<div style="margin-bottom: 0px!important;">
								<p>„Die Berater bei Job2Job überzeugen nicht nur durch ihr fachliches Know-how, sondern auch durch ihr feines Gespür für genau das, was ich als Kunde brauche.“</p>
							</div>
						</div>
					</div>	
				</div>							
			</div><div class="each-slide-kunden" style="">
				<div class="content-center">
					<div class="slider2-content">
						<div class="pagination2" style="display: block;"><a href="#" class=""><span>1</span></a><a href="#" class=""><span>2</span></a><a href="#" class="selected"><span>3</span></a><a href="#" class=""><span>4</span></a></div>
						<div class="vertical-align">
							<div style="margin-bottom: 0px!important;">
								<p>„Job2Job ist unser Nr.1 Ansprechpartner, um kritische Schlüsselpositionen schnell und effizient zu besetzen.“</p>
							</div>
						</div>
					</div>	
				</div>							
			</div><div class="each-slide-kunden" style="">
				<div class="content-center">
					<div class="slider2-content">
						<div class="pagination2" style="display: block;"><a href="#" class=""><span>1</span></a><a href="#" class=""><span>2</span></a><a href="#" class="selected"><span>3</span></a><a href="#" class=""><span>4</span></a></div>
						<div class="vertical-align">
							<div style="margin-bottom: 0px!important;">
								<p>„Im Gespräch mit den Job2Job Consultants hatte ich das Gefühl, dass hier Spaß und Leidenschaft der absolute Erfolgsfaktor sind.“</p>
							</div>
						</div>
					</div>	
				</div>							
			</div></div></div>
					
	</div>    
 
 
 
 
    <div class="boxes-ref">
		<div class="content-center statistic-anim" >
			<div class="width25" ng-repeat="statistc in numberStatictics">
				<div class="vertical-align">
					<h5 class="count_up finished">{{Math.round(statistc.currentValue)}}</h5><h5><em>{{statistc.label}}</em></h5>
				</div>
			</div>
			
			
		</div>
		

		
    </div>
</div>	


    
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
							<div class="title-karriere">IHR PERSÖNLICHER JOB TICKER</div>
							<div class="text-karriere">Jetzt anmelden und Benachrichtigungen über neue Jobs erhalten, die Ihren Wunschkriterien entsprechen.</div>
							<a href="javascript:void(0)">Mehr erfahren</a>						
						</div>		
				 		
				        <div class="box-karriere">
							<img src="<?=Yii::getAlias('@web/web') ?>/images/bird-env.png">
							<div class="title-karriere">JETZT LEBENSLAUF EINREICHEN</div>
							<div class="text-karriere">Sie sind auf der Suche nach einer neuen beruflichen Herausforderung? Reichen Sie Ihren Lebenslauf ein und erhalten Sie auf Sie zugeschnittene Stellenangebote.</div>
							<a href="javascript:void(0)">Mehr erfahren</a>						
						</div>		
				 		
				        <div class="box-karriere">
							<img src="<?=Yii::getAlias('@web/web') ?>/images/edit-note.png">
							<div class="title-karriere">IHRE PERSÖNLICHE MERKLISTE</div>
							<div class="text-karriere">Fügen Sie Stellenanzeigen zu Ihrer persönlichen Merkliste hinzu und haben Sie stets Übersicht über Ihre favorisierten Jobangebote.</div>
							<a href="javascript:void(0)">Mehr erfahren</a>						
						</div>		
				 			</div>
					</div>
	</div>
	



    
    <div class="was_wir_machen">
		<div class="content-center">
    		<div class="width50">
				<h2>UNSER RECRUITING PROZESS<br><strong>FÜR KANDIDATEN</strong></h2>

                <div class="recruitment_hidden">
                    <p>Job2Job zeichnet sich durch das 360° Modell aus.<br>
                        Dabei werden Sie umfassend und nachhaltig von einem Ansprechpartner während des gesamten Prozesses betreut.</p>
                    <p>    
                        Diese Form der Vermittlung garantiert Ihnen hohe Qualitätsstandards sowie Zugriff auf hochspezialisierte Projekte und Positionen.
                    </p>
                </div>
      
                <div class="recruitment_content">
                            
                    <div class="hiddenj2j content_seg1" style="display: block;">
                      <p>1. Kandidaten-Qualifikation<br>
                        Wir verschaffen Ihnen einen realistischen Marktüberblick und definieren gemeinsam mit Ihnen Ihren idealen Job abhängig von u.a.:</p>
                        <p>• Persönlichen Qualifikationen und Berufserfahrung<br>
                        • Gewünschter Position<br>
                        • Gehaltsvorstellung<br>
                        • Entwicklungszielen</p>
                    </div>  
                 
                    <div class="hiddenj2j content_seg2" style="display: none;">
                      <p>2. Präsentation von möglichen Vakanzen<br>
                        Wir stellen Ihnen die aktuell bestmöglichen Positionen vor.</p>
                        <p>• Vorstellen des Anforderungsprofils des Kunden<br>
                        • Liefern von Informationen zu Unternehmensumfeld und Team<br>
                        • Präsentieren vorhandener Benefits</p>
                    </div>  
                 
                    <div class="hiddenj2j content_seg3" style="display: none;">
                      <p>3. Vorstellung Ihres Profils<br>
                        Wir stellen Ihr Profil beim entsprechenden Entscheidungsträger vor und verschaffen Ihnen somit einen Wettbewerbsvorteil.</p>
                        <p>• Optimierung von Bewerbungsunterlagen<br>
                        • Aushändigung der Unterlagen an den Kunden<br>
                        • Übermittlung von Feedback der Entscheidungsträger</p>
                    </div>  
                 
                    <div class="hiddenj2j content_seg4" style="display: none;">
                      <p>4. Interviewprozess<br>
                        Wir begleiten Sie während des gesamten Interviewprozesses.</p>
                        <p>• Koordination der Interviews<br>
                        • Interviewvorbereitung sowie -nachbereitung mit<br>
                        <span style="margin-left: 13px;">Ihnen und dem Kunden</span></p>
                    </div>  
                 
                    <div class="hiddenj2j content_seg5" style="display: none;">
                      <p>5. Vertragsabwicklung</p>
                        <p>• Führen von Vertragsverhandlungen mit Ihnen und dem Kunden<br>
                        • Unterbreiten des Angebots des Kunden<br>
                        • Sicherstellen eines Abschlusses zu Ihrer Zufriedenheit</p>
                    </div>  
                 
                    <div class="hiddenj2j content_seg6" style="display: none;">
                      <p>6. Nachhaltige Betreuung<br>
                        Wir begleiten Sie während des Prozesses und darüber hinaus.</p>
                        <p>• Organisation möglicher Projektverlängerungen (Freelance)<br>
                        • Einholen von Feedback hinsichtlich Ihrer Zufriedenheit</p>
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
                                  	<p class="circle2_text txt1-2">
	                       				<?php echo Yii::t('app', '1.Kandidaten-Qualifikation'); ?>									
 									</p>
                                  </div>
                                </div>
                            </div>
                            <div class="segmentwrapper segment2 fade-in2 two start" id="seg2">
                                <div class="segment">
                                	<div class="inner" id="seg2">
                                		<p class="circle2_text txt2-2" style="max-width: 120px;">
                                           	<?php echo Yii::t('app', '2. Präsentation von möglichen Vakanzen'); ?><br>
 										</p>
                            		</div>
                            	</div>
                            </div>
                            <div class="segmentwrapper segment3 fade-in2 three start" id="seg3">
                                <div class="segment"><div class="inner" id="seg3">
                        		<p class="circle2_text txt3-2">
                                	<?php echo Yii::t('app', '3. Vorstellung Ihres Profils'); ?>
								</p>
                            </div></div>
                            </div>
                            <div class="segmentwrapper segment4 fade-in2 four start" id="seg4">
                                <div class="segment"><div class="inner" id="seg4">
                        		<p class="circle2_text txt4-2">
                                	<?php echo Yii::t('app', '4. Interviewprozess'); ?><br>
    							</p>
                            </div></div>
                            </div>
                            <div class="segmentwrapper segment5 fade-in2 five start" id="seg5">
                                <div class="segment"><div class="inner" id="seg5">
                        		<p class="circle2_text txt5-2">
                                	<?php echo Yii::t('app', '5. Vertragsabwicklung'); ?><br>
								</p>
                            </div></div>
                            </div>
                            <div class="segmentwrapper segment6 fade-in2 six start" id="seg6">
                                <div class="segment"><div class="inner" id="seg6">
                        		<p class="circle2_text txt6-2">
                                	<?php echo Yii::t('app', '6. Nachhaltige Betreuung'); ?><br>
								</p>
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


    
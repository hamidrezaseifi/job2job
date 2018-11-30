<?php

use yii\bootstrap\ActiveForm;

//jobpositionDataProvider
/* @var $this yii\web\View */
/* @var $jobitems string */
/* @var $places array */

$this->title = yii::$app->params['sitetitle'] . ' | ' . Yii::t('app', 'Home Page');

$this->registerJsFile("@web/web/js/index.js", [], 'js-index');

?>

<div ng-controller="IndexController">
	<div class="home home-main-content">
        <div class="home-box-1 top-section top-section-with-boxes" >
        	<div class="vertical-align">
        		<div class="content-center"><h1><h1>Ihre Personalberatung – Job2Job<br><?php echo Yii::t('app', 'Jetzt Top Jobs in Ihrer Nähe finden');?></h1></div>
        	</div>	
        	
        </div>		
	</div>
	


    
    <div class="was_wir_machen">
    	<div class="content-center">
    		<div class="width50">
    			<h2>WAS WIR<br>
                <strong>MACHEN</strong></h2>
    			<p>Als <b>Unternehmer</b> investieren Sie in mühseliges, zeit- und kostenintensives Recruiting mit <br>ungewissen Erfolgschancen? - Nicht mit uns!</p>
    			<p><b>Job2Job GmbH</b> unterstützt Sie von Anfang an bis zum erfolgreichen Abschluss.</p>
    			<p>Egal, ob Sie langfristige oder temporäre Positionen besetzen wollen.</p>
    			<p>Wir stellen Ihnen geeignete Kandidaten vor – und Sie entscheiden nach Ihren Vorstellungen.<br>Das ist alles.</p> 
    			<p>Sie wollen Ihre Entscheidung risikolos testen?<br>Auch das geht - mit einem temporären Überlassungsvertrag, bis Sie sich wirklich sicher sind.</p> 
    			<p class="" ><b>Das ist moderne Personalwirtschaft, zeitsparend und effektiv.</b></p>
    		</div>
    		
    		<div class="width50">
                <div class="main_circle" >
                    <div class="slice slice-1 fade-in one" layout="row" layout-align="center center">
                    	<a href="#">
                        	<div class="home-branches-title home-branches-title-1" >
                        		<img src="<?=Yii::getAlias('@web') ?>/web/images/parma-logo.png" /><br>
                        		<?php echo Yii::t('app', 'Gesundheitswesen'); ?>
                        	</div>                    	
                    	</a>
                    </div>
                    <div class="slice slice-2 fade-in two" layout="row" layout-align="center center">
                    	<a href="#">
                            <div class="home-branches-title home-branches-title-2" >
                            	<?php echo Yii::t('app', 'Kaufmännischer Sektor'); ?><br>
                            	<img src="<?=Yii::getAlias('@web') ?>/web/images/finanz-logo.png" />
                             </div>
                         </a>
                    </div>
                    <div class="slice slice-3 fade-in three" layout="row" layout-align="center center">
                    	<a href="#">
                            <div class="home-branches-title home-branches-title-3" >
                            	<img src="<?=Yii::getAlias('@web') ?>/web/images/engin-logo.png" /><br>
                            	<?php echo Yii::t('app', 'Industrie und Handwerk'); ?>
                            </div>
                        </a>
                    </div>
                    <div class="slice slice-4 fade-in six" layout="row" layout-align="center center">
                    	<a href="#">
                            <div class="home-branches-title home-branches-title-4" >
                            	<?php echo Yii::t('app', 'Ingenieurwesen und Technik'); ?><br>
                            	<img src="<?=Yii::getAlias('@web') ?>/web/images/engin-logo.png" />
                            </div>
                        </a>
                    </div>
                    <div class="slice slice-5 fade-in five" layout="row" layout-align="center center">
                    	<a href="#">
                            <div class="home-branches-title home-branches-title-5" >
                            	<img src="<?=Yii::getAlias('@web') ?>/web/images/engin-logo.png" /><br>
                            	<?php echo Yii::t('app', 'Lager und Logistik'); ?>
                            </div>
                        </a>
                    </div>
                    <div class="slice slice-6 fade-in four" layout="row" layout-align="center center">
                    	<a href="#">
                            <div class="home-branches-title" >
                            	<?php echo Yii::t('app', 'Produktion und Gewerbe'); ?><br>
                            	<img src="<?=Yii::getAlias('@web') ?>/web/images/engin-logo.png" />
                            </div>
                        </a>
                    </div>
                

                </div>

    		</div>
    		<br>
    		<br>
    		<div class="width50 weiter_lesen" style="display: none;"><p>Wir haben uns auf die Personalvermittlung im Bereich Medizintechnik , pharmazeutische Industrie und Engineering spezialisiert und vermitteln hoch qualifizierte Fach- und Führungskräfte bis hin zum Top Management. Ob Sie als Unternehmen nach Mitarbeitern bzw. Freelancern suchen oder als Bewerber nach einer neuen Herausforderung – bei der ARISTO Group können Sie sich auf eine individuelle Beratung, eine ehrliche Kommunikation sowie eine vertrauensvolle Zusammenarbeit verlassen.</p>
                <p>QUALIFIZIERTE MITARBEITER ZUR FESTANSTELLUNG UND FREELANCER FÜR PROJEKTE</p>
                <p>Neue Mitarbeiter in Festanstellung sind in der heutigen Zeit extrem rar und schwer zu gewinnen, vor allem, wenn es sich um Spezialbereiche mit entsprechend anspruchsvollem Know-how handelt. Ebenso schwierig ist es für Unternehmen, erfahrene hoch qualifizierte Freelancer zu finden, welche für Projekte flexibel zur Verfügung stehen und sich dank ihrer Erfahrung schnell und unkompliziert in neue Aufgaben einarbeiten können.</p>
                <p>Für all dies brauchen Sie einen zuverlässigen und kompetenten Partner: Wir, die ARISTO Group, unterstützen Sie schnell und kompetent, auch in hektischen Zeiten. Als international agierende Personalberatung mit Sitz in München und Zürich können wir auf ein weitreichendes Netzwerk zurückgreifen, wodurch wir schnell auf Ihre Projekte, plötzliche Personalausfälle oder fehlendes Know-how reagieren können.</p>
                <p>INTERNATIONALE PERSONALBERATUNG – ARISTO BIETET IHNEN INDIVIDUELLE PERSONALLÖSUNGEN</p>
                <p>Seit über 10 Jahren sind wir Spezialisten in der Personalberatung bzw. -vermittlung für die Pharmaindustrie, Medizintechnik sowie Engineering – nicht nur für München, sondern auch national und international.<br>
                Sie können sich daher bei unseren Mitarbeitern auf kompetente Ansprechpartner für Ihre Entscheidungsträger verlassen.<br>
                Darüber hinaus legen wir großen Wert auf eine professionelle, individuelle Beratung und den Aufbau von langfristigen und nachhaltigen Geschäftsbeziehungen.</p>
                <p>Unsere Personalberater besprechen mit Ihnen das Anforderungsprofil sowie die Rahmenbedingungen der Stelle bzw. des Projekts und finden anhand dieser Informationen genau die Personen, die Sie suchen. So wollen wir nachhaltig einen Mehrwert für Sie schaffen. Beratung bedeutet für uns eine offene, transparente Kommunikation. Unsere international ausgerichtete Personalberatung mit Sitz in München arbeitet nicht mit versteckten Kosten – ARISTO vertraut auf einen erfolgsorientierten Ansatz.</p>
    			<a href="javascript:void(0)"><span class="close_btn"><p>&lt; Zuklappen</p></span></a>
    		</div>
    	</div>	
    </div>
    
    
    
    
    
    <div class="all-slider das_sagen_kunden" style="">
				
			<div class="content-center">
				<h2 style="position: absolute;">DAS SAGEN<strong>UNSERE KUNDEN</strong></h2></div>
				<div class="caroufredsel_wrapper" style="display: block; text-align: start; float: none; position: relative; top: auto; right: auto; bottom: auto; left: auto; z-index: auto;margin: 0px; overflow: hidden;"><div class="slider-kunden" style="text-align: left; float: none; position: absolute; top: 0px; right: auto; bottom: auto; left: 0px; margin: 0px; width: 17127px; height: 600px; z-index: auto; opacity: 1;">
		
	 				<div class="each-slide-kunden" style="">
				<div class="content-center">
					<div class="slider2-content">
						<div class="pagination2" style="display: block;"><a href="#" class=""><span>1</span></a><a href="#" class=""><span>2</span></a><a href="#" class="selected"><span>3</span></a><a href="#" class=""><span>4</span></a></div>
						<div class="vertical-align">
							<div style="margin-bottom: 0px!important;">
								<p>„Top-Qualität, Top-Leistung, Top-Betreuung!“</p>
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
								<p>„Die Berater bei Aristo überzeugen nicht nur durch ihr fachliches Know-how, sondern auch durch ihr feines Gespür für genau das, was ich als Kunde brauche.“</p>
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
								<p>„Aristo ist unser Nr.1 Ansprechpartner, um kritische Schlüsselpositionen schnell und effizient zu besetzen.“</p>
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
								<p>„Im Gespräch mit den Aristo Consultants hatte ich das Gefühl, dass hier Spaß und Leidenschaft der absolute Erfolgsfaktor sind.“</p>
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
    						<p style="height:200px; overflow:hidden; ">
    							<?php echo $jobModel->comments?>
    						</p>
    						<p><?php echo $jobModel->city?></p>
    						<p style=" ">
    						
    							<a href="<?=Yii::getAlias('@web') ?>/site/jobview?id=<?php echo $jobModel->id; ?>">Mehr erfahren &gt;</a>
    						</p>
    					</div>
    				<?php }?>
    
    		</div>	
    				<div class="button-aktuelle">
    			<p><a href="https://aristo-group.com/jobboerse/">JOB SUCHEN</a></p>
    		</div>
    	</div>
    </div>
</div>	


    
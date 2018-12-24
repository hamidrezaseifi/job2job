<?php
use yii\bootstrap\ActiveForm;

// jobpositionDataProvider
/* @var $this yii\web\View */
/* @var $jobitems string */
/* @var $places array */

$this->title = yii::$app->params ['sitetitle'] . ' | ' . Yii::t ( 'app', 'Home Page' );

$this->registerJsFile ( "@web/web/js/index.js", [ ], 'js-index' );
$this->registerJsFile ( "@web/web/js/segments.js", [ ], 'js-segments' );
$this->registerCssFile ( "@web/web/css/segments.css", [ ], 'css-segment' );

?>

<div ng-controller="IndexController">
	<div class="home home-main-content">
        <div class="home-box-1 top-section top-section-with-boxes" >
        	<?php echo $this->render('topbanner', ['showSearch' => true]);?>
        </div>
	</div>

    <div class="was_wir_machen">
		<div class="content-center">
    		<div class="width50">
    			<h2>Was wir machen</h2>
    			<p>Die <b>Job2Job GmbH</b> mit Sitz in Hameln, ist eine inhabergeführte Personalberatung, die sich in die Branchen – Medizin, Pharmazie, Pflege und Industrie spezialisiert hat.</p>
				<br>
                <p>Wir vermitteln Fach- und Führungskräfte, sowohl für Projekte als auch für Festeinstellungen.</p>
                <p>Mit der <b>Job2Job</b> Personalberatung erhalten Sie professionellen Partner, der für Ihre personellen Vakanzen passgenaue Lösungen liefert.</p>
                <p>Wir haben uns auf die Personalvermittlung in den Branchen – Medizin, Pharmazie, Pflege und Industrie spezialisiert und vermitteln qualifizierte Fachkräfte. </p>
				<br>
                <p>Ob Sie als <b>Unternehmen</b> nach <b>Mitarbeitern</b> oder als <b>Bewerber</b> nach einer neuen Herausforderung suchen – bei <b>Job2Job</b> können Sie sich auf eine individuelle Beratung, eine transparente Kommunikation sowie eine vertrauensvolle Zusammenarbeit verlassen.</p>
				<br>
                <p><a href="<?=Yii::getAlias ( '@web' )?>/site/whatwedo"><b>Mehr erfahren</b></a> </p>


    		</div>

    		<div class="width50">
                <div class="squarewrapper2">
                    <div class="square2 square-fixed">
                        <div class="csscircle circleRad2">
                            <div class="segmentwrapper segment1 fade-in2 one start" id="seg1">
                                <div class="segment">
                                  <div class="inner" id="seg1" data-link="<?=Yii::getAlias ( '@web' )?>/site/branchview/med">
                                  	<p class="circle2_text txt1-2">
	                       				<?php

echo Yii::t ( 'app', 'Gesundheitswesen' );
																												?>
										<img src="<?=Yii::getAlias ( '@web' )?>/web/images/parma-logo.png" /><br>
 									</p>
                                  </div>
                                </div>
                            </div>
                            <div class="segmentwrapper segment2 fade-in2 two start" id="seg2">
                                <div class="segment">
                                	<div class="inner" id="seg2" data-link="<?=Yii::getAlias ( '@web' )?>/site/branchview/commercial">
                                		<p class="circle2_text txt2-2">
                                           	<?php

echo Yii::t ( 'app', 'Kaufmännischer Sektor' );
																																												?><br>
                                            <img src="<?=Yii::getAlias ( '@web' )?>/web/images/finanz-logo.png" />
 										</p>
                            		</div>
                            	</div>
                            </div>
                            <div class="segmentwrapper segment3 fade-in2 three start" id="seg3">
                                <div class="segment"><div class="inner" id="seg3" data-link="<?=Yii::getAlias ( '@web' )?>/site/branchview/industry">
                        		<p class="circle2_text txt3-2">
                                	<?php

echo Yii::t ( 'app', 'Industrie und Handwerk' );
																																	?>
                                	<img src="<?=Yii::getAlias ( '@web' )?>/web/images/engin-logo.png" />
								</p>
                            </div></div>
                            </div>
                            <div class="segmentwrapper segment4 fade-in2 four start" id="seg4">
                                <div class="segment"><div class="inner" id="seg4" data-link="<?=Yii::getAlias ( '@web' )?>/site/branchview/engineering">
                        		<p class="circle2_text txt4-2">
                                	<?php

echo Yii::t ( 'app', 'Ingenieurwesen und Technik' );
																																	?><br>
                                	<img src="<?=Yii::getAlias ( '@web' )?>/web/images/engin-logo.png" />
    							</p>
                            </div></div>
                            </div>
                            <div class="segmentwrapper segment5 fade-in2 five start" id="seg5">
                                <div class="segment"><div class="inner" id="seg5" data-link="<?=Yii::getAlias ( '@web' )?>/site/branchview/logistic">
                        		<p class="circle2_text txt5-2">
                                	<?php

echo Yii::t ( 'app', 'Lager und Logistik' );
																																	?><br>
                                	<img src="<?=Yii::getAlias ( '@web' )?>/web/images/engin-logo.png" />
								</p>
                            </div></div>
                            </div>
                            <div class="segmentwrapper segment6 fade-in2 six start" id="seg6">
                                <div class="segment"><div class="inner" id="seg6" data-link="<?=Yii::getAlias ( '@web' )?>/site/branchview/production">
                        		<p class="circle2_text txt6-2">
                                	<?php

echo Yii::t ( 'app', 'Produktion und Gewerbe' );
																																	?><br>
                                	<img src="<?=Yii::getAlias ( '@web' )?>/web/images/engin-logo.png" />
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


    <div class="unsere-werte">
    	<div class="content-center">
    		<h3 class="light-and-bold" style="color: #FFFFFF">UNSERE<strong> WERTE</strong></h3>

    		<div class="width100-unsere">
    			<div class="width50">
    				<div class="each-unsere">
    					<div class="title"><div class="width-title"><span>01</span>KOMPETENZ</div></div>

    					<div class="text">Aufgrund unserer Fachkompetenz kommunizieren wir mit unseren Kunden und Kandidaten auf Augenhöhe,<br>
                        beraten sie professionell und besetzen somit Positionen schnellstmöglich.
                        </div>
    				</div>
    			</div>

    			<div class="width50">
    				<div class="each-unsere" style="margin-top: 100px;">
    					<div class="title"><div class="width-title"><span>02</span>NACHHALTIGKEIT & VERBINDLICHKEIT</div></div>

    					<div class="text"> Unser Bestreben ist der Auf- und Ausbau langfristiger und nachhaltiger Beziehungen.<br>
							Verbindlichkeit ist hierbei die Basis einer vertrauensvollen Zusammenarbeit.
    					</div>
    				</div>
    			</div>
    		</div>

    		<div class="width100-unsere">
    			<div class="width50">
    				<div class="each-unsere" style="margin-top: 20px;">
    					<div class="title"><div class="width-title"><span>03</span>TEAM</div></div>

    					<div class="text">Enge Zusammenarbeit und gegenseitiges Vertrauen lässt uns als Mannschaft gewinnen.</div>
    				</div>
    			</div>

    			<div class="width50">
    				<div class="each-unsere" style="margin-top: 30px;">
    					<div class="title"><div class="width-title"><span>04</span>LEIDENSCHAFT</div></div>

    					<div class="text">Unser Herzblut treibt uns zur Höchstleistung an.</div>
    				</div>
    			</div>
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
						<div class="pagination2" style="display: block;">
							<a ng-click="showPaginationContent('1', $event)" id="link1" class="selected"><span>1</span></a>
							<a ng-click="showPaginationContent('2', $event)" id="link2" class=""><span>2</span></a>
							<a ng-click="showPaginationContent('3', $event)" id="link3" class=""><span>3</span></a>
						</div>
						<div class="vertical-align">
							<div style="margin-bottom: 0px!important;" class="pagination-content">
                                <div id="item1" class="fade in">
                                  <p>„Die Personalberater bei Job2Job hören zu, was ich bei anderen Personaldienstlern vermisse und somit bekommt unser Unternehmen genau das, was wir als Kunde brauchen.“</p>
                                </div>
                                <div id="item2" class="fade">
                                  <p>„Mittlerweile ist Job2Job zu unser Nr.1 in jeglichen Personalanfragen geworden. Hier zählt Qualität vor Quantität.“</p>
                                </div>
                                <div id="item3" class="fade">
                                  <p>„Im Gespräch mit den Job2Job Disponenten hatte ich das Gefühl, <br>
									dass hier Spaß und Leidenschaft der absolute Erfolgsfaktor sind.“</p>
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
    				<?php

foreach ( $jobModels as $jobModel ) {
									$jobtitle = $jobModel->title; // strlen($jobModel->title) > 32 ? substr($jobModel->title , 0 , 30) . ' ...' : $jobModel->title;
									?>
    					<div class="box-aktuelle" style="position:relative;" onclick="location.href='<?=Yii::getAlias ( '@web' )?>/site/jobview?id=<?php

echo $jobModel->id;
									?>'">
    						<h4><?php

echo $jobtitle?></h4>
    						<div style="margin: 10px 0;"><?php

echo $jobModel->city?></div>
    						<div style="max-height:220px; height:220px; overflow:hidden; ">
    							<?php

echo $jobModel->comments?>
    						</div>
    						<p style="margin-top: 15px;">
    							<a href="<?=Yii::getAlias ( '@web' )?>/site/jobview?id=<?php

echo $jobModel->id;
									?>">Mehr erfahren &gt;</a>
    						</p>
    					</div>
    				<?php

}
								?>

    		</div>
    				<div class="button-aktuelle">
    			<p><a href="<?=Yii::getAlias ( '@web' )?>/site/searchjobs/">JOB SUCHEN</a></p>
    		</div>
    	</div>
    </div>
</div>



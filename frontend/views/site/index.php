<?php
use yii\bootstrap\ActiveForm;

// jobpositionDataProvider
/* @var $this yii\web\View */
/* @var $jobitems string */
/* @var $places array */
/* @var $recommendations array */
/* @var $jobModels array */

$this->title = yii::$app->params ['sitetitle'] . ' | ' . Yii::t ( 'app', 'Home Page' );

$this->registerJsFile ( "@web/web/js/index.js", [ ], 'js-index' );
$this->registerJsFile ( "@web/web/js/segments.js", [ ], 'js-segments' );
$this->registerJsFile ( "@web/web/js/recommandation-slider.js", [ ], 'js-recommandation-slider' );
$this->registerCssFile ( "@web/web/css/segments.css", [ ], 'css-segment' );
$this->registerCssFile ( "@web/web/css/index.css", [ ], 'css-index' );

$user = Yii::$app->user;
$identity = $user->identity;
$isCompany = $identity ? $identity->isCompany() : false;

?>

<div ng-controller="IndexController">
	<div class="home home-main-content">
        <div class="home-box-1 top-section top-section-with-boxes" >
        	<?php echo $this->render('topbanner', ['showSearch' => ($user->isGuest || !$isCompany), 'showEmployeeFinder' => (!$user->isGuest && $isCompany)]);?>
        </div>
	</div>

	<div class="home home-teaser">
		<div class="teaser-box-container">
    		<div class="teaser-box">
    			<div class="teaser-heaser">FÜR UNTERNEHMEN</div>
    			<div class="teaser-text">Teaser Text für Unternehmen</div>
    			<a class="teaser-link" href="<?=Yii::getAlias ( '@web' )?>/site/whyjob2job">Warum-Job2Job? >> </a>
    		</div>
		</div>
		
		<div class="teaser-box-container">		
    		<div class="teaser-box">
    			<div class="teaser-heaser">FÜR BEWERBER</div>
    			<div class="teaser-text">Teaser Text für Bewerber</div>
    			<a class="teaser-link" href="<?=Yii::getAlias ( '@web' )?>/site/whyjob2job">Warum-Job2Job? >> </a>
    		</div>
		</div>
		
		<div class="teaser-box-container">		
    		<div class="teaser-box">
    			<div class="teaser-heaser">JOBBÖRSE</div>
    			<div class="teaser-text">Teaser Text für Jobbörse</div>
    			<a class="teaser-link" href="<?=Yii::getAlias ( '@web' )?>/site/searchjobs">Aktuelle Stellenangebote >> </a>
    		</div>
		</div>
		<div class="clear"></div>
	</div>

	<?php if(false) {?>
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
	<?php } ?>

    <div class="all-slider recommendations-slider <?php echo ($recommendations[0]->iscandidate == 1 ? 'das_sagen_kunden_candidate' : 'das_sagen_kunden') ?>" style="">
				
		<div class="content-center candidate-recommand-title"><h2 style="position: absolute;">DAS SAGEN<strong>UNSERE KUNDEN</strong></h2></div>
		<div class="content-center compnay-recommand-title"><h2 style="position: absolute;">DAS SAGEN<strong>UNSERE KANDIDATEN</strong></h2></div>
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

    <div class="boxes-ref">
		<div class="content-center statistic-anim" >
			<div class="width25" ng-repeat="statistc in numberStatictics">
				<div class="vertical-align">
					<h5 class="count_up finished">{{Math.round(statistc.currentValue)}}</h5><h5><em>{{statistc.label}}</em></h5>
				</div>
			</div>


		</div>



    </div>

    <?php echo $this->render('blue-jobposition-list', [
        'jobModels' => $jobModels,
        'showSearch' => true, 
        'showMoreFromBranch' => false, 
        'forTitle' => 'FÜR BEWERBER']);
    ?>
    
    
</div>



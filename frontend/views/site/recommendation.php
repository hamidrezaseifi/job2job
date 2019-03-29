<?php
/* @var $this yii\web\View */
/* @var $jobitems string */
/* @var $recommendations string */

use yii\helpers\Html;


?>

    <div class="all-slider recommendations-slider <?php echo ($recommendations[0]->iscandidate == 1 ? 'das_sagen_kunden_candidate' : 'das_sagen_kunden') ?>" style="">
				
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
                                    	<?php if($recommendation->iscandidate){?>
										<div class="recommand-title candidate-recommand-title"><h2 style="">DAS SAGEN<strong>UNSERE KANDIDATEN</strong></h2></div>
										<?php } else {?>
										<div class="recommand-title candidate-recommand-title"><h2 style="">DAS SAGEN<strong>UNSERE KUNDEN</strong></h2></div>
										<?php } ?>                                    	
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

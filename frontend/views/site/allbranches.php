<?php

/* @var $this yii\web\View */

use yii\helpers\Html;

if(!$isindex)
{
	$this->registerJsFile("@web/web/js/allbranches.js", [], 'js-allbranches');
}

$this->registerCssFile("@web/web/css/allbranches.css", [], 'css-allbranches');

?>

<div class="site-allbranches" <?php if(!$isindex){ ?>ng-controller="AllBranchesController" <?php } ?>>


	<div class="allbranches-title j2jgreentext">
		Branchen
	</div>
	
	<div class="allbranches-part-4" id="allbranches-part-4">
		<div style="width: 1210px; margin:auto; ">
			<div class="allbranches-part-4-in allbranches-part-4-in-1">
				<div class="allbranches-part-4-in-title" ><?php echo Yii::t('app', 'Gesundheitswesen'); ?></div>
				<div class="flex" ><img class="allbranches-part-4-in-image" alt="" src="<?=Yii::getAlias('@web') ?>/web/images/branch-med.jpg"></div>
				
				<div class="allbranches-part-4-in-text">Medizinische Fachangestellte (m/w)</div>
				<div class="allbranches-part-4-in-text">Examinierte Krankenschwestern/pfleger</div>
				<div class="allbranches-part-4-in-text">Sonst. med. Fachpersonal (m/w)</div>
				<div class="allbranches-part-4-in-text">Fach- und Hilfspflegepersonal (m/w)</div>
				
				<div class="allbranches-part-4-in-text"><a href="<?=Yii::getAlias('@web') ?>/site/branch?type=med">Mehr Profile</a></div>
			</div>
			
			<div class="allbranches-part-4-in allbranches-part-4-in-2">
				<div class="allbranches-part-4-in-title" ><?php echo Yii::t('app', 'Kaufmännischer Sektor'); ?></div>
				<div class="flex" ><img class="allbranches-part-4-in-image" alt="" src="<?=Yii::getAlias('@web') ?>/web/images/branch-buss.jpg"></div>
				
				<div class="allbranches-part-4-in-text">Sekretär/Assistent (m/w)</div>
				<div class="allbranches-part-4-in-text">Sachbearbeiter (m/w)</div>
				<div class="allbranches-part-4-in-text">Finanz-/Bilanzbuchhalter (m/w)</div>
				<div class="allbranches-part-4-in-text">Betriebs-/Wirtschaftswirtschaftler (m/w)</div>
				
				<div class="allbranches-part-4-in-text"><a href="<?=Yii::getAlias('@web') ?>/site/branch?type=commercial">Mehr Profile</a></div>
			</div>
			
			<div class="allbranches-part-4-in allbranches-part-4-in-3">
				<div class="allbranches-part-4-in-title" ><?php echo Yii::t('app', 'Industrie und Handwerk'); ?></div>
				<div class="flex" ><img class="allbranches-part-4-in-image" alt="" src="<?=Yii::getAlias('@web') ?>/web/images/branch-industry.png"></div>
				
				<div class="allbranches-part-4-in-text">Handwerker-Gesellen/-Meister</div>
				<div class="allbranches-part-4-in-text">Schlosser, Metallbauer</div>
				<div class="allbranches-part-4-in-text">Staplerfahrer</div>
				<div class="allbranches-part-4-in-text">Hilfskräfte</div>
				<div class="allbranches-part-4-in-text"><a href="<?=Yii::getAlias('@web') ?>/site/branch?type=industry">Mehr Profile</a></div>
			</div>
	
			<div class="allbranches-part-4-in allbranches-part-4-in-4">
				<div class="allbranches-part-4-in-title" ><?php echo Yii::t('app', 'Ingenieurwesen und Technik'); ?></div>
				<div class="flex" ><img class="allbranches-part-4-in-image" alt="" src="<?=Yii::getAlias('@web') ?>/web/images/branch-eng.png"></div>
				
				<div class="allbranches-part-4-in-text">Ingenieure / Techniker Industrie (m/w)</div>
				<div class="allbranches-part-4-in-text">Industriefachleute (m/w)</div>
				<div class="allbranches-part-4-in-text">Architekten / Bauingenieure (m/w)</div>
				<div class="allbranches-part-4-in-text">Medizintechniker (m/w)</div>
				

				<div class="allbranches-part-4-in-text"><a href="<?=Yii::getAlias('@web') ?>/site/branch?type=engineering">Mehr Profile</a></div>
			</div>
			
			<div class="allbranches-part-4-in allbranches-part-4-in-5">
				<div class="allbranches-part-4-in-title" ><?php echo Yii::t('app', 'Lager und Logistik'); ?></div>
				<div class="flex" ><img class="allbranches-part-4-in-image" alt="" src="<?=Yii::getAlias('@web') ?>/web/images/branch-logistic.png"></div>
				<div class="allbranches-part-4-in-text">Logistiker (m/w)</div>
				<div class="allbranches-part-4-in-text">Staplerfahrer (m/w)</div>
				<div class="allbranches-part-4-in-text">Lagerfachkräfte (m/w)</div>
				<div class="allbranches-part-4-in-text">Hilfskräfte (m/w)</div>

				<div class="allbranches-part-4-in-text"><a href="<?=Yii::getAlias('@web') ?>/site/branch?type=logistic">Mehr Profile</a></div>
			</div>
			
			<div class="allbranches-part-4-in allbranches-part-4-in-6">
				<div class="allbranches-part-4-in-title" ><?php echo Yii::t('app', 'Produktion und Gewerbe'); ?></div>
				<div class="flex" ><img class="allbranches-part-4-in-image" alt="" src="<?=Yii::getAlias('@web') ?>/web/images/branch-production.png"></div>
				
				<div class="allbranches-part-4-in-text">Logistiker (m/w)</div>
				<div class="allbranches-part-4-in-text">Staplerfahrer (m/w)</div>
				<div class="allbranches-part-4-in-text">Lagerfachkräfte (m/w)</div>
				<div class="allbranches-part-4-in-text">Hilfskräfte (m/w)</div>
				
				<div class="allbranches-part-4-in-text"><a href="<?=Yii::getAlias('@web') ?>/site/branch?type=production">Mehr Profile</a></div>
			</div>	
			<div class="clear"></div>	
		</div>

		
	</div>

</div>


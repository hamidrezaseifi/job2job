<?php

/* @var $this yii\web\View */

use yii\helpers\Html;

$this->registerCssFile("@web/web/css/imageheader.css", [], 'css-imageheader');

?>

<div class="site-whyjob2job">
	
    <div class="anim-image-header" style="background-image: url(<?=Yii::getAlias('@web') ?>/web/images/Gesundheitswesen.jpg);">
    
    		<div class="anim-image-title">
    			<?php echo Yii::t('app', 'PERSONALÜBERNAHME'); ?>
    		</div>
    </div>

	<h1><?php echo Yii::t('app', 'PERSONALÜBERNAHME'); ?></h1>
</div>

<?php

/* @var $this yii\web\View */
/* @var $pdfList array */

use yii\helpers\Html;

$this->registerCssFile("@web/web/css/certificates.css", [], 'css-certificates');
$this->registerCssFile("@web/web/css/imageheader.css", [], 'css-imageheader');

?>
<div class="certificates-container">

    <div class="anim-image-header" style="background-image: url(<?=Yii::getAlias('@web') ?>/web/images/certificates.jpg); background-size: 100vw;">
    
		<div class="anim-image-title">
			<?php echo Yii::t('app', 'Zertifikate'); ?>
		</div>
    </div>
        
    <div class="certificates">
        
        <div class="certificates-title j2jgreenback">
        	<?php echo Yii::t('app', 'Zertifikate'); ?>
        </div>
        
        <div class="certificates-item-container">
        	<?php foreach($pdfList as $pdf) {?>
        	<a href="<?php echo $pdf['file']?>" target="_blank">
    	        <div class="certificates-item" style="background-image: url(<?php echo $pdf['image']?>); ">
    			    <div class="certificates-item-desc">
    			    <span><b><?php echo $pdf['title']?></b><br>
    			    <?php echo $pdf['desc']?></span>
    		    	</div>
    	    	</div>
            </a>
        
        	<?php } ?>
        	
        	<div class="clear"></div>
        </div>
    
    </div>

</div>
    

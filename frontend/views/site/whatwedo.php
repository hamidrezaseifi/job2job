<?php

/* @var $this yii\web\View */
use yii\helpers\Html;

$this->registerCssFile("@web/web/css/whatwedo.css", [ ], 'css-wahtwedo');
$this->registerCssFile("@web/web/css/imageheader.css", [ ], 'css-imageheader');

?>
<div class="site-wahtwedo">
	<div class="anim-image-header" style="background-image: url(<?=Yii::getAlias('@web')?>/web/images/whatdowedo.jpg); background-size: 100vw;">

			<div class="anim-image-title">
				Was wir machen
			</div>
	</div>
	<?php

	echo $this->render("whatwedo-content")?>


</div>





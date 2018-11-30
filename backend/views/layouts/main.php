<?php

/* @var $this \yii\web\View */
/* @var $content string */

use backend\assets\AppAsset;
use yii\helpers\Html;
use yii\widgets\Breadcrumbs;
use common\widgets\Alert;
use yii\helpers\Url;
use common\lib\NavigationBase;
use backend\components\BrainNavbar;
use yii\base\Widget;
use common\lib\BrainSiteUserManager;

AppAsset::register($this);

$drawmenu = !isset($_GET['nomenu']) || $_GET['nomenu'] != "1";

?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode(Yii::$app->params['sitetitle']) ?></title>
    <?php $this->head() ?>
    <link rel="icon" type="image/png" href="<?=Yii::getAlias('@web/web/images') ?>/site-icon.jpg">
    <script type="text/javascript" src="<?=Yii::getAlias('@web/web') ?>/js/datepicker-de.js"></script>
</head>
<body>
<?php $this->beginBody() ?>

<div class="wrap">
    <?php
    
    if($drawmenu)
    {
	    if (Yii::$app->user->isGuest) {
	        $menuItems = array(array('label' => 'Login', 'url' => ['/site/login'] , 'image'=>'glyphicon glyphicon-log-in'));
	    } else {
	    	$allowed_nav = BrainSiteUserManager::getAllowedNavigationList();
	    	//print_r($allowed_nav);
	    	$menuItems = NavigationBase::listNavigation('en', 'backend' , 0 , $allowed_nav);
	    	
	        $menuItems[] = array('label' => 'Logout', 'url' => array('/site/logout') , 'image'=>'glyphicon glyphicon-log-out');
	    }
	
	    echo BrainNavbar::widget(['items' => $menuItems , 'navid' => 'dvleftmenu' , 
	    		'navclass' => 'navbar-inverse' , 
	    		'navstyle' => 'float: left; width: 200px;  ' , 
	    ]);
    }
    
    ?>

	
	<div class="container" style="float: left; width: calc(100vw - 220px); ">
	
        <?= $drawmenu ? Breadcrumbs::widget([
            'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
        ]) : '' ?>
        <?= $drawmenu ? Alert::widget() : '' ?>
        <?= $content ?>
	</div>
	<div style="clear: both;"></div>
	<?php if($drawmenu) {?>
    <footer class="footer">
    <div class="container">
        <p class="pull-left">&copy; My Company <?= date('Y') ?></p>

        <p class="pull-right"><?= Yii::powered() ?></p>
    </div>
    </footer>
    <?php } ?>
</div>



<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>

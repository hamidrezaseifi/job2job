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

//print_r($this->params['breadcrumbs']); exit;

$this->params['breadcrumbs'] = isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : array();

?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?=Yii::$app->language?>" ng-app="brainApp">

<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode(Yii::$app->params['sitetitle']) ?></title>
    <?php $this->head() ?>
    <link rel="icon" type="image/png" href="<?=Yii::getAlias('@web/web/images') ?>/site-icon.jpg">
    <script type="text/javascript" src="<?=Yii::getAlias('@web/web') ?>/js/datepicker-de.js"></script>
    <script src="<?=Yii::getAlias ( '@web' )?>/web/js/mainlayout.js"></script>
</head>
<body ng-controller="BodyController">
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
	    	$menuItems = NavigationBase::listNavigation('de', 'backend' , 0 , $allowed_nav);
	    	
	        $menuItems[] = array('label' => 'Logout', 'url' => array('/site/logout') , 'image'=>'glyphicon glyphicon-log-out');
	    }
	
	    echo BrainNavbar::widget(['items' => $menuItems , 'navid' => 'dvleftmenu' , 
	    		'navclass' => 'navbar-inverse backend-navbar' , 
	    		 
	    ]);
    }
    
    ?>

	
	<div class="container backend-container" style=" ">
	
        <nav aria-label="breadcrumb">
          <ol class="breadcrumb">
          	<?php foreach ($this->params['breadcrumbs'] as $index => $breadcrumb) { 
          	    $isactive = $index == count($this->params['breadcrumbs']) - 1 ? 'active' : '';
          	    $iscurrent = $index == count($this->params['breadcrumbs']) - 1 ? 'aria-current="page"' : '';
          	    
          	    $bcontent = '';
          	    
          	    if(is_string($breadcrumb)){
          	        $bcontent = $breadcrumb;
          	    }
          	    else {
          	        if(isset($breadcrumb['url']) && isset($breadcrumb['label'])){
          	            $bcontent = Html::a($breadcrumb['label'], $breadcrumb['url']);
          	        }
          	        
          	    }
          	    
          	    
          	    
          	    ?>
          	    <li class="breadcrumb-item <?php echo $isactive?>" <?php echo $iscurrent?>><?php echo $bcontent?></li>
          	<?php } ?>
          </ol>
        </nav>
	
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

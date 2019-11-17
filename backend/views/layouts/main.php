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

//print_r($this->params['breadcrumbs']); exit;

$this->params['breadcrumbs'] = isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : array();

if (Yii::$app->user->isGuest) {
    $menuItems = array(array('label' => 'Login', 'url' => ['/site/login'] , 'image'=>'glyphicon glyphicon-log-in'));
} else {
    $allowed_nav = BrainSiteUserManager::getAllowedNavigationList();
    //print_r($allowed_nav);
    $menuItems = NavigationBase::listNavigation('de', 'backend' , 0 , $allowed_nav);
    
    $menuItems[] = array('label' => 'Logout', 'url' => array('/site/logout') , 'image'=>'/web/images/icons/exit.png');
}


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

	<nav class="navbar navbar-expand-lg navbar-brain">
		<div class="collapse navbar-collapse" id="navbarSupportedContent">
			<ul class="navbar-nav mr-auto">
			
			<?php foreach ($menuItems as $menu){
			     
			    
			    if(isset($menu['childs']) && count($menu['childs']) > 0){
			        ?>
              <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                  <?=$menu['label'] ?>
                <?php if(strlen($menu['image']) > 5 ){?>
                <img alt="" src="<?=Yii::getAlias('@web') . $menu['image'] ?>" width="20">
                <?php } ?>
                </a>
                <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                <?php foreach ($menu['childs'] as $submenu){ ?>
                  <a class="dropdown-item" href="<?=Url::toRoute($submenu['url']) ?>"><?=$submenu['label'] ?>
                    <?php if(strlen($submenu['image']) > 5 ){?>
                    <img alt="" src="<?=Yii::getAlias('@web') . $submenu['image'] ?>" width="20">
                    <?php } ?>
                    </a>
                <?php } ?>
                </div>
              </li>
			        
			        <?php 
			    }
			    else{
			    ?>
              <li class="nav-item active">
                <a class="nav-link" href="<?=Url::toRoute($menu['url']) ?>"><?=$menu['label'] ?> 
                <?php if(strlen($menu['image']) > 5 ){?>
                <img alt="" src="<?=Yii::getAlias('@web') . $menu['image'] ?>" width="20">
                <?php } ?>
                </a>
              </li>
              
              <?php } } ?>
			
			</ul>
		</div>
	</nav>
	
    <?php
    if(false){
	
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
	
        <?= $content ?>
	</div>
	<div style="clear: both;"></div>
    <footer class="footer">
    <div class="container">
        <p class="pull-left">&copy; My Company <?= date('Y') ?></p>

        <p class="pull-right"><?= Yii::powered() ?></p>
    </div>
    </footer>
</div>



<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>

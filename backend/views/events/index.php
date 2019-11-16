<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $logModels common\lib\FrontlogBase */
/* @var $logList array */

$this->registerCssFile("@web/web/css/logs.css");
$this->registerJsFile("@web/web/js/events.js", [], 'js-events');

$this->title = Yii::t('app', 'Fronend Geschehen ...');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="frontlog-base-index" ng-controller="EventsController">

    <h1 style="height: 50px; line-height: 50px;">
    	<?= Html::encode($this->title) ?> 
    	<img id="imgloading" ng-show="isloading" width="50" src="<?php echo Yii::getAlias('@web'); ?>/web/images/loading-2.gif">
    	<button class="reload" ng-show="!isloading" ng-click="loadnext()"><span class="glyphicon glyphicon-refresh"></span></button>
    </h1>
    
    <div class="lastlog"></div>
	<div ng-repeat="event in events" class="logdiv" ng-bind-html="event.desc" ></div>

</div>


        
<script type="text/javascript">
	var eventsurl = '<?php echo Yii::getAlias("@web")?>/events/nextlog?lastid=';
</script>
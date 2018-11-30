<?php

use yii\helpers\Html;
use yii\grid\GridView;
use backend\components\SkillsTreeView;
use yii\base\Widget;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $searchModel common\models\SkillsSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Skills');
$this->params['breadcrumbs'][] = $this->title;

$this->registerJsFile(Yii::$app->urlManager->createUrl('web/js/skillindex.js')  , ['position' => 3]);

?>
<div class="skills-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <div class="skills-index" id="dvtree">
<?php 
	echo SkillsTreeView::widget(['viewid' => 'dvskilltree' , 
    		'viewclass' => 'table table-striped table-bordered' , 
    		'viewstyle' => '' , 
    ])
?>
</div>
</div>

<div id="dvdialog" >

</div>

<div id="dvdeleteskill" >
	<h4><?php echo Yii::t('app', 'Are you sure to delete this Skill?')  ?></h4>
</div>

    <?php ActiveForm::begin(['id' => 'frmdeleteskill' , 'action' => Yii::$app->urlManager->createUrl('skills/delete') ]); ?>

    <?= Html::hiddenInput('id' , '' , ['id' => 'hdndeleteid']); ?>
    
    <?php ActiveForm::end(); ?>

<script type="text/javascript">
$(".skilltool").hide();
$(".skillrow").mousemove(function(){
	//alert($(this).children("td").first().children("span.skilltool").length);
	$(this).children("td").first().children("span.skilltool").show();
});

$(".skillrow").mouseout(function(){
	//alert($(this).children("td").first().children("span.skilltool").length);
	$(this).children("td").first().children("span.skilltool").hide();
});

var global_messages = new Array();
<?php 

echo 'global_messages["ok"] = "' . Yii::t('app', 'OK') . '";' . PHP_EOL;
echo 'global_messages["cancel"] = "' . Yii::t('app', 'Cancel') . '";' . PHP_EOL;
echo 'global_messages["edit skill"] = "' . Yii::t('app', 'Edit Skill') . '";' . PHP_EOL;
echo 'global_messages["delete skill"] = "' . Yii::t('app', 'Delete Skill') . '";' . PHP_EOL;


?>
	var rooturl = "<?=Yii::getAlias('@web') ?>/skills";
</script>

<?php

use yii\helpers\Html;
use yii\grid\GridView;
use backend\components\SkillsTreeView;
use yii\base\Widget;
use yii\widgets\ActiveForm;
use backend\components\SkillsTreeViewList;

/* @var $this yii\web\View */
/* @var $searchModel common\models\SkillsSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Skills');
$this->params['breadcrumbs'][] = $this->title;

$this->registerJsFile(Yii::$app->urlManager->createUrl('web/js/skillindex.js')  , ['position' => 3]);

?>
<div class="skills-index" ng-controller="SkillsController">

    <h1>
    	<?= Html::encode($this->title) ?> &nbsp; &nbsp; &nbsp; &nbsp; 
    	<label style="font-size: 16px;">Alle</label> <input type="radio" name="show" checked ng-click="toggleShowed('all')">&nbsp; 
    	<label style="font-size: 16px;">Nur Inaktiv</label> <input type="radio" name="show" ng-click="toggleShowed('inactive')">&nbsp; 
    	<label style="font-size: 16px;">Nur Aktiv</label> <input type="radio" name="show" ng-click="toggleShowed('active')">
    
    </h1>
    <div></div>
    <div class="skills-index" id="dvtree">
<?php 
    echo SkillsTreeViewList::widget(['viewid' => 'dvskilltree' , 
    		'viewclass' => 'table table-striped table-bordered' , 
    		'viewstyle' => '' , 
    ])
?>

	
	</div>
	
    <div class="modal fade" id="editSkillDialog" tabindex="-1" role="dialog" aria-labelledby="editSkillDialogTitle" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLongTitle">Skill Bearbeiten</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <label style="margin-right: 10px;">Skill</label>
            <input type="text" id="editSkillInput" ng-model="selctedSkill" style="width: calc(100% - 80px);"><br>
            <label style="margin-right: 30px;">Status</label>
            <label style="margin-right: 10px;" for="selctedSkillStatusActive">Aktiv</label><input style="margin-right: 10px;" type="radio" id="selctedSkillStatusActive" ng-checked="selctedSkillStatus == 1" ng-model="selctedSkillStatus" value="1">
            <label style="margin-right: 10px;" for="selctedSkillStatusInActive">Inaktiv</label><input style="margin-right: 10px;" type="radio" id="selctedSkillStatusInActive" ng-checked="selctedSkillStatus == 0" ng-model="selctedSkillStatus" value="0">
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-primary" ng-disabled="selctedSkill == ''" ng-click="saveSelectedSkill()">Speichern</button>
          </div>
        </div>
      </div>
    </div>
	
<?php ActiveForm::begin(['id' => 'skillform']); ?>
<?php ActiveForm::end(); ?>
	
</div>


<script type="text/javascript">

var approveUrl = '<?=Yii::getAlias('@web') ?>/skills/approve';
var updateUrl = '<?=Yii::getAlias('@web') ?>/skills/update';
var global_messages = new Array();
<?php 

echo 'global_messages["ok"] = "' . Yii::t('app', 'OK') . '";' . PHP_EOL;
echo 'global_messages["cancel"] = "' . Yii::t('app', 'Cancel') . '";' . PHP_EOL;
echo 'global_messages["edit skill"] = "' . Yii::t('app', 'Edit Skill') . '";' . PHP_EOL;
echo 'global_messages["delete skill"] = "' . Yii::t('app', 'Delete Skill') . '";' . PHP_EOL;


?>
	var rooturl = "<?=Yii::getAlias('@web') ?>/skills";
</script>

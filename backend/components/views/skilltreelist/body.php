<?php
use common\lib\SkillsBase;
use yii\helpers\Url;

/* @var $model common\lib\SkillsSearchBase */
/* @var $level int */
/* @var $viewclass string */
/* @var $viewstyle string */
/* @var $disabled boolean */
/* @var $tools array */



?>

<tr class="skillrow" data-status="<?=$model->status ?> " data-skill="<?=$model->id ?>" ng-show="isStatusShowed(<?=$model->status ?>)">
<td class="tree_sep <?= (($model->status == 0 )? 'tree_status_lock' : (($model->status == 2 )? 'tree_status_notapp' : '')); ?>" style="background-position-x: <?= 40 * $level ?>px; padding-left: <?= 23 * ($level + 1) ?>px"  title="<?= SkillsBase::statusTitle($model->status)  ?>" >
<span>
<?php
echo ( $model->status == 2 ? '* ' : '');
echo $model->title . '&nbsp; &nbsp; ';
echo ( $model->status == 0 ? '<img class="inactived" alt="" src="' . Yii::getAlias('@web') . '/web/images/icons/lock.png" width="20">' : '');
?>
</span>
</td>
<td class="statustitle">
<?=$model->status == 0 ? 'Inaktiv' : 'Aktive' ?>
</td>
<td>
<?php if($model->parentid != 0){?>
<a style="cursor: pointer;" title="Bearbeiten" ng-click="editSkill(<?=$model->id ?>, '<?=$model->title ?>', <?=$model->status ?>);"><img alt="" src="<?=Yii::getAlias('@web') ?>/web/images/icons/edit.png" width="20"></a>
<?php if($model->status == 0){?>
<a  style="cursor: pointer;" title="Genehmigen" class="approve" ng-click="approveSkill(<?=$model->id ?>);"><img alt="" src="<?=Yii::getAlias('@web') ?>/web/images/icons/done.png" width="20"></a>
<?php } ?>
<a href="<?=Url::to(['skills/delete' , 'id' => $model->id]) ?>" title="Löschen" aria-label="Löschen" data-confirm="Möchten Sie diesen Artikel wirklich löschen?" data-method="post" data-pjax="0"><img alt="" src="<?=Yii::getAlias('@web') ?>/web/images/icons/trash.png" width="20"></a>
<?php } ?>
</td>
</tr>


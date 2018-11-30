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

<tr class="skillrow">
<td class="tree_sep <?= (($model->status == 0 )? 'tree_status_lock' : (($model->status == 2 )? 'tree_status_notapp' : '')); ?>" style="background-position-x: <?= 40 * $level ?>px; padding-left: <?= 23 * ($level + 1) ?>px"  title="<?= SkillsBase::statusTitle($model->status)  ?>" >
<span>
<?php
echo ( $model->status == 2 ? '* ' : '');
echo $model->title . '&nbsp; &nbsp; ';
echo ( $model->status == 0 ? '<span class="status glyphicon glyphicon-lock"></span>' : '');
echo ( $model->status == 2 ? '<span class="status glyphicon glyphicon-check"></span>' : '');
?>
</span>
<span style="padding-left: 50px;" class="skilltool">
<?php 
if(!isset($tools) || !is_array($tools))
	echo '&nbsp;';
else 
{
	foreach ($tools as $toolname)
	{
		//echo $toolname . ', ';
		switch($toolname)
		{
			case 'edit' : echo '<a href="#" title="' . Yii::t('app', 'Edit') . '" onclick="edit_skill(' . $model->id . ');" ><span class="glyphicon glyphicon-pencil"></span></a>&nbsp;'; 
				break;
			case 'addchild' : echo '<a href="#" title="' . Yii::t('app', 'Add Sub Skill') . '" onclick="add_sub_skill(' . $model->id . ');" ><span class="glyphicon glyphicon-plus-sign"></span></a>&nbsp;';
				break;
			case 'delete' : echo '<a href="' . Url::to(['skills/delete' , 'id' => $model->id]) . '" title="' . Yii::t('app', 'Delete') . '" aria-label="' . Yii::t('app', 'Delete') . '" data-confirm="Are you sure you want to delete this Skill?" data-method="post" data-pjax="0"><span class="glyphicon glyphicon-trash"></span></a>&nbsp;';
				break;
		}
	}
}

?>
</span>

</td>
</tr>


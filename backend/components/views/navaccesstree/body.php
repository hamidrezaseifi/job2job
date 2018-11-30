<?php
/* @var $model common\lib\NavigationBase */
/* @var $level int */
/* @var $viewclass string */
/* @var $viewstyle string */
/* @var $tools array */
/* @var $allow_edit boolean */
/* @var $accessModel common\lib\UsergroupnavgationBase */


?>

<tr>
<td class="" style="background-position-x: <?= 40 * $level ?>px; padding-left: <?= 23 * ($level + 1) ?>px">
<?php 
echo $model->title;

?>
</td>
<td class="tree_nav_access ">
<?php 
	echo $model->language0->title;
?>
</td>
<td class="tree_nav_access ">
<?php 
	if(!$allow_edit)
		echo ( ($accessModel && $accessModel->readright) ? '&nbsp;X&nbsp;' : '&nbsp; &nbsp;');
	else 
	{?>
		<input name="navaccessread[<?=$model->id ?>]" type="checkbox" <?php echo ( ($accessModel && $accessModel->readright) ? 'checked="checked"' : ''); ?>>
<?php }
?>
</td>
<td class="tree_nav_access ">
<?php 
	if(!$allow_edit)
		echo ( ($accessModel && $accessModel->editright) ? '&nbsp;X&nbsp;' : '&nbsp; &nbsp;');
	else
	{?>
		<input name="navaccessedit[<?=$model->id ?>]" type="checkbox" <?php echo ( ($accessModel && $accessModel->editright) ? 'checked="checked"' : ''); ?>>
	<?php }
?>
</td>
<td class="tree_nav_access ">
<?php 
	if(!$allow_edit)
		echo ( ($accessModel && $accessModel->deleteright) ? '&nbsp;X&nbsp;' : '&nbsp; &nbsp;');
	else
	{?>
		<input name="navaccessdelete[<?=$model->id ?>]" type="checkbox" <?php echo ( ($accessModel && $accessModel->deleteright) ? 'checked="checked"' : ''); ?>>
<?php }
?>
</td>
<td class="tree_nav_access ">
<?php 
	if(!$allow_edit)
		echo ( ($accessModel && $accessModel->printright) ? '&nbsp;X&nbsp;' : '&nbsp; &nbsp;');
	else
	{?>
		<input name="navaccessprint[<?=$model->id ?>]" type="checkbox" <?php echo ( ($accessModel && $accessModel->printright) ? 'checked="checked"' : ''); ?>>
	<?php }
?>
</td>

</tr>

